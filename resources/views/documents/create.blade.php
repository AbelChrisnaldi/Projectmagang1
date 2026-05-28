<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Dokumen
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <form method="POST" action="{{ route('documents.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Dokumen</label>
                        <input id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="border rounded px-3 py-2 w-full"
                               required>
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700 mb-1">Link Dokumen</label>
                        <input id="link"
                               type="url"
                               name="link"
                               value="{{ old('link') }}"
                               class="border rounded px-3 py-2 w-full"
                               required>
                        @error('link')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Simpan
                        </button>

                        <a href="{{ route('documents.index') }}"
                           class="text-gray-600 hover:underline">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
