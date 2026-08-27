<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Management') }}
            </h2>

            <a href="{{ route('admin.users.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                + Tambah User
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="border-b dark:border-gray-700">
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Role</th>
                                    <th class="px-4 py-3">Department</th>
                                    <th class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">
                                            {{ $user->name }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                            {{ $user->email }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                            {{ $user->role?->name ?? 'Belum ada role' }}
                                        </td>

                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">
                                            {{ $user->department?->name ?? 'Belum ada department' }}
                                        </td>

                                        <td class="px-4 py-3">
                                            <div class="flex gap-2">

                                                <a href="{{ route('admin.users.show', $user) }}"
                                                   class="px-3 py-1 bg-gray-600 text-white rounded hover:bg-gray-700">
                                                    Detail
                                                </a>

                                                <a href="{{ route('admin.users.edit', $user) }}"
                                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                    Edit
                                                </a>

                                                @if (auth()->id() !== $user->id)
                                                    <form action="{{ route('admin.users.destroy', $user) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                                class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            class="px-4 py-6 text-center text-gray-500">
                                            Belum ada user.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>