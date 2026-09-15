<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['user', 'assignedUser'])
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'open';

        Ticket::create($validated);

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Tiket berhasil dibuat.');
    }

    public function show(string $id)
    {
        $ticket = Ticket::with(['user', 'assignedUser'])
            ->findOrFail($id);

        $users = User::with('role')
            ->orderBy('name')
            ->get();

        return view('tickets.show', compact('ticket', 'users'));
    }

    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Assign ticket oleh Admin.
     */
    public function assign(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'assigned_to' => 'required|exists:users,id',
        ]);

        $ticket->update([
            'assigned_to' => $validated['assigned_to'],
            'status' => 'in_progress',
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Ticket berhasil ditugaskan.');
    }

    /**
     * Resolve ticket oleh Teknisi.
     */
    public function resolve(Ticket $ticket)
    {
        // Pastikan ticket memang ditugaskan kepada teknisi
        // yang sedang login.
        if ($ticket->assigned_to !== auth()->id()) {
            abort(403, 'Ticket ini bukan tanggung jawab Anda.');
        }

        // Ticket hanya bisa diselesaikan jika statusnya
        // sedang In Progress.
        if ($ticket->status !== 'in_progress') {
            return redirect()
                ->route('tickets.show', $ticket)
                ->with('error', 'Ticket belum berstatus In Progress.');
        }

        $ticket->update([
            'status' => 'resolved',
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Ticket berhasil diselesaikan.');
    }

    public function destroy(string $id)
    {
        //
    }
}