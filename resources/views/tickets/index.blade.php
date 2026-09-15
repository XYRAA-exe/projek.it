<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Tiket IT Support
                        </h3>

                        <a href="{{ route('tickets.create') }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            + Buat Tiket
                        </a>
                    </div>

                    @if ($tickets->count())
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead>
                                    <tr class="border-b dark:border-gray-700">
                                        <th class="px-4 py-3">ID</th>
                                        <th class="px-4 py-3">Judul</th>
                                        <th class="px-4 py-3">Pembuat</th>
                                        <th class="px-4 py-3">Kategori</th>
                                        <th class="px-4 py-3">Prioritas</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr class="border-b dark:border-gray-700">

                                            <td class="px-4 py-3">
                                                #{{ $ticket->id }}
                                            </td>

                                            <td class="px-4 py-3 font-medium">
                                                {{ $ticket->title }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $ticket->user?->name ?? '-' }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ $ticket->category }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ ucfirst($ticket->priority) }}
                                            </td>

                                            <td class="px-4 py-3">
                                                {{ ucfirst($ticket->status) }}
                                            </td>

                                            <td class="px-4 py-3">
                                                <a href="{{ route('tickets.show', $ticket) }}"
                                                   class="text-blue-600 hover:underline">
                                                    Detail
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $tickets->links() }}
                        </div>
                    @else
                        <div class="text-center py-10 text-gray-500">
                            Belum ada tiket.
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>