<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detail User') }}
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

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">

            <div class="p-6">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $user->name }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            ID User: #{{ $user->id }}
                        </p>
                    </div>

                    <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">
                        {{ $user->role?->name ?? 'Belum ada role' }}
                    </span>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700">

                    {{-- Nama --}}
                    <div class="py-4 flex justify-between">
                        <span class="font-medium text-gray-500">
                            Nama
                        </span>

                        <span class="text-gray-900 dark:text-white">
                            {{ $user->name }}
                        </span>
                    </div>

                    {{-- Email --}}
                    <div class="py-4 flex justify-between border-t border-gray-200 dark:border-gray-700">
                        <span class="font-medium text-gray-500">
                            Email
                        </span>

                        <span class="text-gray-900 dark:text-white">
                            {{ $user->email }}
                        </span>
                    </div>

                    {{-- Role --}}
                    <div class="py-4 flex justify-between border-t border-gray-200 dark:border-gray-700">
                        <span class="font-medium text-gray-500">
                            Role
                        </span>

                        <span class="text-gray-900 dark:text-white">
                            {{ $user->role?->name ?? '-' }}
                        </span>
                    </div>

                    {{-- Department --}}
                    <div class="py-4 flex justify-between border-t border-gray-200 dark:border-gray-700">
                        <span class="font-medium text-gray-500">
                            Department
                        </span>

                        <span class="text-gray-900 dark:text-white">
                            {{ $user->department?->name ?? '-' }}
                        </span>
                    </div>

                    {{-- Dibuat --}}
                    <div class="py-4 flex justify-between border-t border-gray-200 dark:border-gray-700">
                        <span class="font-medium text-gray-500">
                            Dibuat
                        </span>

                        <span class="text-gray-900 dark:text-white">
                            {{ $user->created_at?->format('d M Y H:i') ?? '-' }}
                        </span>
                    </div>

                    {{-- Diperbarui --}}
                    <div class="py-4 flex justify-between border-t border-gray-200 dark:border-gray-700">
                        <span class="font-medium text-gray-500">
                            Terakhir diperbarui
                        </span>

                        <span class="text-gray-900 dark:text-white">
                            {{ $user->updated_at?->format('d M Y H:i') ?? '-' }}
                        </span>
                    </div>

                </div>

                <div class="mt-6 flex justify-end gap-3">

                    <a href="{{ route('admin.users.edit', $user) }}"
                       class="px-5 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        Edit User
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Kembali
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>
```

</x-app-layout>
