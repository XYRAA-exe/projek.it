<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Dashboard IT Support
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Selamat datang kembali, {{ Auth::user()->name }} 👋
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Total User --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Total User
                                </p>

                                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                    1
                                </h3>
                            </div>

                            <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                                👤
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Ticket --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Total Ticket
                                </p>

                                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                    0
                                </h3>
                            </div>

                            <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-full">
                                🎫
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ticket Open --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Ticket Open
                                </p>

                                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                    0
                                </h3>
                            </div>

                            <div class="bg-red-100 dark:bg-red-900 p-3 rounded-full">
                                🔴
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Ticket Selesai --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Ticket Selesai
                                </p>

                                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-2">
                                    0
                                </h3>
                            </div>

                            <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                                ✅
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Informasi User --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Profile --}}
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6">

                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                            Informasi Akun
                        </h3>

                        <div class="space-y-3">

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

                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Department
                                </p>

                                <p class="font-medium text-gray-800 dark:text-gray-100">
                                    {{ Auth::user()->department->name ?? 'Belum ada department' }}
                                </p>
                            </div>

                        </div>

                    </div>
                </div>

                {{-- Ticket Terbaru --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">

                    <div class="p-6">

                        <div class="flex items-center justify-between mb-4">

                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                                Ticket Terbaru
                            </h3>

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Belum ada ticket
                            </span>

                        </div>

                        <div class="border border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-10 text-center">

                            <div class="text-4xl mb-3">
                                🎫
                            </div>

                            <h4 class="text-gray-700 dark:text-gray-200 font-medium">
                                Belum ada ticket
                            </h4>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Ticket IT Support akan muncul di sini.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>