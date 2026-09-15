<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard IT Support
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Selamat datang kembali, {{ Auth::user()->name }} 👋
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ============================= --}}
            {{-- STATISTIK --}}
            {{-- ============================= --}}

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Total Ticket --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Total Ticket
                        </p>

                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                            {{ $totalTickets }}
                        </h3>

                        <div class="mt-2">
                            🎫
                        </div>
                    </div>
                </div>

                {{-- Open --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Ticket Open
                        </p>

                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                            {{ $openTickets }}
                        </h3>

                        <div class="mt-2">
                            🔴
                        </div>
                    </div>
                </div>

                {{-- In Progress --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            In Progress
                        </p>

                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                            {{ $inProgressTickets }}
                        </h3>

                        <div class="mt-2">
                            🟡
                        </div>
                    </div>
                </div>

                {{-- Resolved --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Ticket Resolved
                        </p>

                        <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                            {{ $resolvedTickets }}
                        </h3>

                        <div class="mt-2">
                            🟢
                        </div>
                    </div>
                </div>

            </div>


            {{-- ============================= --}}
            {{-- TICKET --}}
            {{-- ============================= --}}

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <div class="flex items-center justify-between mb-6">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                @if(Auth::user()->role && Auth::user()->role->name === 'Teknisi')
                                    Ticket Saya
                                @else
                                    Ticket Terbaru
                                @endif
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                @if(Auth::user()->role && Auth::user()->role->name === 'Teknisi')
                                    Ticket yang ditugaskan kepada Anda.
                                @else
                                    Ticket terbaru dalam sistem.
                                @endif
                            </p>
                        </div>

                        <a
                            href="{{ route('tickets.index') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                        >
                            Lihat Semua
                        </a>

                    </div>


                    @if($tickets->count() > 0)

                        <div class="overflow-x-auto">

                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            ID
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Judul
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Kategori
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Prioritas
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Status
                                        </th>

                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">

                                    @foreach($tickets as $ticket)

                                        <tr>

                                            <td class="px-4 py-4 text-sm text-gray-900 dark:text-white">
                                                #{{ $ticket->id }}
                                            </td>

                                            <td class="px-4 py-4 text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $ticket->title }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                                {{ $ticket->category }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                                {{ ucfirst($ticket->priority) }}
                                            </td>

                                            <td class="px-4 py-4 text-sm">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                            </td>

                                            <td class="px-4 py-4 text-sm">
                                                <a
                                                    href="{{ route('tickets.show', $ticket) }}"
                                                    class="text-blue-600 hover:text-blue-800"
                                                >
                                                    Detail
                                                </a>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="border border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-10 text-center">

                            <div class="text-4xl mb-3">
                                🎫
                            </div>

                            <h4 class="text-gray-700 dark:text-gray-200 font-medium">
                                Belum ada ticket
                            </h4>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Ticket akan muncul di sini.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ============================= --}}
            {{-- INFORMASI AKUN --}}
            {{-- ============================= --}}

            <div class="mt-6 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                        Informasi Akun
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Nama
                            </p>

                            <p class="font-medium text-gray-800 dark:text-gray-100">
                                {{ Auth::user()->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Email
                            </p>

                            <p class="font-medium text-gray-800 dark:text-gray-100">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Role
                            </p>

                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ Auth::user()->role->name ?? 'Belum ada role' }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>