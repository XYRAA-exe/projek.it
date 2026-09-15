<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Buat Tiket Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('tickets.store') }}">

                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Judul Masalah
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            class="w-full rounded-lg border-gray-300"
                            placeholder="Contoh: Printer tidak bisa mencetak"
                        >
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Kategori
                        </label>

                        <select
                            name="category"
                            required
                            class="w-full rounded-lg border-gray-300"
                        >
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Software">Software</option>
                            <option value="Network">Network</option>
                            <option value="Printer">Printer</option>
                            <option value="CCTV">CCTV</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium mb-2">
                            Prioritas
                        </label>

                        <select
                            name="priority"
                            required
                            class="w-full rounded-lg border-gray-300"
                        >
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium mb-2">
                            Deskripsi Masalah
                        </label>

                        <textarea
                            name="description"
                            rows="6"
                            required
                            class="w-full rounded-lg border-gray-300"
                            placeholder="Jelaskan masalah yang terjadi..."
                        >{{ old('description') }}</textarea>
                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                        >
                            Buat Tiket
                        </button>

                        <a
                            href="{{ route('tickets.index') }}"
                            class="px-5 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"
                        >
                            Batal
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>