<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit User') }}
            </h2>

```
        <a href="{{ route('admin.users.index') }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            ← Kembali
        </a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg">
                        <strong>Terjadi kesalahan:</strong>

                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-5">
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                            Nama
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               required
                               class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-5">
                        <label for="email"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                            Email
                        </label>

                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               required
                               class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-5">
                        <label for="password"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                            Password Baru
                        </label>

                        <input type="password"
                               id="password"
                               name="password"
                               class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                        <p class="mt-1 text-xs text-gray-500">
                            Kosongkan jika tidak ingin mengubah password.
                        </p>

                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-5">
                        <label for="password_confirmation"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                            Konfirmasi Password Baru
                        </label>

                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>

                    {{-- Role --}}
                    <div class="mb-5">
                        <label for="role_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                            Role
                        </label>

                        <select id="role_id"
                                name="role_id"
                                required
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                            <option value="">-- Pilih Role --</option>

                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('role_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Department --}}
                    <div class="mb-6">
                        <label for="department_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                            Department
                        </label>

                        <select id="department_id"
                                name="department_id"
                                required
                                class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                            <option value="">-- Pilih Department --</option>

                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('department_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('admin.users.index') }}"
                           class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            Batal
                        </a>

                        <button type="submit"
                                class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
```

</x-app-layout>
