<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Assign Ticket - Admin
Route::post('/tickets/{ticket}/assign', [TicketController::class, 'assign'])
    ->middleware(['auth', 'role:Admin'])
    ->name('tickets.assign');

// Resolve Ticket - Teknisi
Route::post('/tickets/{ticket}/resolve', [TicketController::class, 'resolve'])
    ->middleware(['auth', 'role:Teknisi'])
    ->name('tickets.resolve');
    
// Close Ticket - Admin
Route::post('/tickets/{ticket}/close', [TicketController::class, 'close'])
    ->middleware(['auth', 'role:Admin'])
    ->name('tickets.close');

// Admin Test
Route::get('/admin-test', function () {
    return 'Halo Admin! Akses berhasil.';
})->middleware(['auth', 'role:Admin']);

// Admin User Management
Route::middleware(['auth', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource(
            'users',
            \App\Http\Controllers\Admin\UserController::class
        );

    });

// Dashboard
Route::get('/dashboard', function () {

    $user = auth()->user();

    // Dashboard Teknisi
    if ($user->role && $user->role->name === 'Teknisi') {

        $tickets = \App\Models\Ticket::with(['user', 'assignedUser'])
            ->where('assigned_to', $user->id)
            ->latest()
            ->get();

        $totalTickets = $tickets->count();

        $openTickets = $tickets
            ->where('status', 'open')
            ->count();

        $inProgressTickets = $tickets
            ->where('status', 'in_progress')
            ->count();

        $resolvedTickets = $tickets
            ->where('status', 'resolved')
            ->count();

        return view('dashboard', compact(
            'tickets',
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'resolvedTickets'
        ));
    }

    // Dashboard Admin
    $totalTickets = \App\Models\Ticket::count();

    $openTickets = \App\Models\Ticket::where(
        'status',
        'open'
    )->count();

    $inProgressTickets = \App\Models\Ticket::where(
        'status',
        'in_progress'
    )->count();

    $resolvedTickets = \App\Models\Ticket::where(
        'status',
        'resolved'
    )->count();

    $tickets = \App\Models\Ticket::with([
        'user',
        'assignedUser'
    ])
        ->latest()
        ->take(5)
        ->get();

    $totalUsers = \App\Models\User::count();

    return view('dashboard', compact(
        'tickets',
        'totalTickets',
        'openTickets',
        'inProgressTickets',
        'resolvedTickets',
        'totalUsers'
    ));

})->middleware(['auth', 'verified'])->name('dashboard');


// Profile & Ticket
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Ticket
    Route::resource('tickets', TicketController::class);

});

require __DIR__.'/auth.php';