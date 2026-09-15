<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Detail Tiket
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">

                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Ticket #{{ $ticket->id }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            Dibuat {{ $ticket->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    <a
                        href="{{ route('tickets.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"
                    >
                        Kembali
                    </a>

                </div>


                {{-- Pesan sukses --}}
                @if(session('success'))

                    <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>

                @endif


                {{-- Pesan error --}}
                @if(session('error'))

                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                        {{ session('error') }}
                    </div>

                @endif


                {{-- Error validasi --}}
                @if($errors->any())

                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">

                        <ul class="list-disc list-inside">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <div class="space-y-5">


                    {{-- Judul --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Judul
                        </p>

                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $ticket->title }}
                        </p>

                    </div>


                    {{-- Pembuat --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Pembuat
                        </p>

                        <p class="text-gray-900 dark:text-white">
                            {{ $ticket->user->name ?? '-' }}
                        </p>

                    </div>


                    {{-- Kategori --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Kategori
                        </p>

                        <p class="text-gray-900 dark:text-white">
                            {{ $ticket->category }}
                        </p>

                    </div>


                    {{-- Prioritas --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Prioritas
                        </p>

                        <p class="text-gray-900 dark:text-white">
                            {{ ucfirst($ticket->priority) }}
                        </p>

                    </div>


                    {{-- Status --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Status
                        </p>

                        <p class="text-gray-900 dark:text-white">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </p>

                    </div>


                    {{-- Ditugaskan --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Ditugaskan Kepada
                        </p>

                        <p class="text-gray-900 dark:text-white">
                            {{ $ticket->assignedUser->name ?? 'Belum ditugaskan' }}
                        </p>

                    </div>


                    {{-- Assign Ticket --}}
                    @if(
                        auth()->user()->role &&
                        auth()->user()->role->name === 'Admin'
                    )

                        <div class="mt-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">

                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">
                                Assign Ticket
                            </p>


                            <form
                                method="POST"
                                action="{{ route('tickets.assign', $ticket) }}"
                            >

                                @csrf


                                <div class="flex gap-3">

                                    <select
                                        name="assigned_to"
                                        class="flex-1 rounded-lg border-gray-300 dark:bg-gray-800 dark:text-white"
                                        required
                                    >

                                        <option value="">
                                            -- Pilih User --
                                        </option>


                                        @foreach($users as $user)

                                            <option
                                                value="{{ $user->id }}"
                                                {{ $ticket->assigned_to == $user->id ? 'selected' : '' }}
                                            >

                                                {{ $user->name }}

                                                @if($user->role)

                                                    - {{ $user->role->name }}

                                                @endif

                                            </option>

                                        @endforeach

                                    </select>


                                    <button
                                        type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                                    >
                                        Assign Ticket
                                    </button>

                                </div>

                            </form>

                        </div>

                    @endif


                    {{-- Selesaikan Ticket --}}
                    @if(
                        auth()->user()->role &&
                        auth()->user()->role->name === 'Teknisi' &&
                        $ticket->assigned_to == auth()->id() &&
                        $ticket->status === 'in_progress'
                    )

                        <div class="mt-6 p-4 bg-yellow-50 dark:bg-gray-700 rounded-lg">

                            <p class="text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">
                                Aksi Teknisi
                            </p>


                            <form
                                method="POST"
                                action="{{ route('tickets.resolve', $ticket) }}"
                                onsubmit="return confirm('Yakin ticket ini sudah selesai?')"
                            >

                                @csrf


                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700"
                                >
                                    ✓ Selesaikan Ticket
                                </button>

                            </form>

                        </div>

                    @endif


                    {{-- Deskripsi --}}
                    <div>

                        <p class="text-sm text-gray-500">
                            Deskripsi
                        </p>


                        <div class="mt-2 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">

                            <p class="text-gray-900 dark:text-white whitespace-pre-line">
                                {{ $ticket->description }}
                            </p>

                        </div>

                    </div>


                </div>

            </div>

        </div>
    </div>

</x-app-layout>