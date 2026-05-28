<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dokumen
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Tambah Dokumen</h3>

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

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Daftar Dokumen</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="p-2 text-left">Dokumen</th>
                                <th class="p-2 text-left">Link Dokumen</th>
                                <th class="p-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $document)
                                <tr class="border-t">
                                    <td class="p-2">
                                        <a href="{{ $document->link }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="text-blue-600 hover:underline">
                                            {{ $document->name }}
                                        </a>
                                    </td>
                                    <td class="p-2">
                                        <a href="{{ $document->link }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="text-blue-600 hover:underline break-all">
                                            {{ $document->link }}
                                        </a>
                                    </td>
                                    <td class="p-2">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('documents.edit', $document) }}"
                                               class="text-blue-600 hover:underline">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('documents.destroy', $document) }}"
                                                  onsubmit="return confirm('Hapus dokumen ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="p-4 text-center text-gray-500">
                                        Belum ada dokumen
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
