<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Kegiatan Akademik
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- FORM INPUT --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Tambah Kegiatan</h3>

                <form method="POST" action="{{ route('kegiatan.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="date" name="tanggal"
                               class="border rounded px-3 py-2"
                               required>

                        <input type="text" name="kegiatan"
                               placeholder="Nama Kegiatan"
                               class="border rounded px-3 py-2"
                               required>
                    </div>

                    <textarea name="outline"
                              placeholder="Outline kegiatan"
                              class="border rounded px-3 py-2 w-full mt-4"
                              rows="3"></textarea>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <input type="url" name="link_slide"
                               placeholder="Link Slide"
                               class="border rounded px-3 py-2">

                        <input type="url" name="link_notulensi"
                               placeholder="Link Notulensi"
                               class="border rounded px-3 py-2">
                    </div>

                    <button type="submit"
                            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Tambah Kegiatan
                    </button>
                </form>
            </div>

            {{-- TABEL DATA --}}
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Daftar Kegiatan</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="p-2 text-left">Tanggal</th>
                                <th class="p-2 text-left">Kegiatan</th>
                                <th class="p-2 text-left">Outline</th>
                                <th class="p-2 text-center">Slide</th>
                                <th class="p-2 text-center">Notulensi</th>
                                <th class="p-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kegiatans as $k)
                                <tr class="border-t">
                                    <td class="p-2">{{ $k->tanggal }}</td>
                                    <td class="p-2">{{ $k->kegiatan }}</td>
                                    <td class="p-2 whitespace-pre-line">
                                        {{ $k->outline }}
                                    </td>
                                    <td class="p-2 text-center">
                                        @if($k->link_slide)
                                            <a href="{{ $k->link_slide }}"
                                               target="_blank"
                                               class="text-blue-600 hover:underline">
                                                Link
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="p-2 text-center">
                                        @if($k->link_notulensi)
                                            <a href="{{ $k->link_notulensi }}"
                                               target="_blank"
                                               class="text-blue-600 hover:underline">
                                                Link
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="p-2 text-center">
                                        <form method="POST"
                                              action="{{ route('kegiatan.destroy', $k->id) }}"
                                              onsubmit="return confirm('Hapus kegiatan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="p-4 text-center text-gray-500">
                                        Belum ada data
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
