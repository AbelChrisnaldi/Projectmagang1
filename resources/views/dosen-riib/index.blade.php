<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List Dosen Riib
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
                <h3 class="text-lg font-semibold mb-4">Tambah Data Dosen</h3>

                <form method="POST" action="{{ route('dosen-riib.store') }}" class="space-y-4">
                    @csrf

                    @include('dosen-riib.partials.form-fields')

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Daftar Dosen Riib</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-200">
                        <thead class="bg-blue-600 text-white">
                            <tr>
                                <th class="p-2 text-left">ID</th>
                                <th class="p-2 text-left">Kode Dosen</th>
                                <th class="p-2 text-left">Nama Dosen</th>
                                <th class="p-2 text-left">Prodi</th>
                                <th class="p-2 text-left">KK</th>
                                <th class="p-2 text-left">JAD</th>
                                <th class="p-2 text-left">Sub KK</th>
                                <th class="p-2 text-left">Pendidikan Terakhir</th>
                                <th class="p-2 text-left">Tahun Masuk</th>
                                <th class="p-2 text-left">Studi Lanjut</th>
                                <th class="p-2 text-left">NIDN</th>
                                <th class="p-2 text-left">NIP</th>
                                <th class="p-2 text-left">CoE</th>
                                <th class="p-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dosenRiibs as $dosenRiib)
                                <tr class="border-t">
                                    <td class="p-2">{{ $dosenRiib->id }}</td>
                                    <td class="p-2">{{ $dosenRiib->kode_dosen }}</td>
                                    <td class="p-2">{{ $dosenRiib->nama_dosen }}</td>
                                    <td class="p-2">{{ $dosenRiib->prodi }}</td>
                                    <td class="p-2">{{ $dosenRiib->kk }}</td>
                                    <td class="p-2">{{ $dosenRiib->jad }}</td>
                                    <td class="p-2">{{ $dosenRiib->sub_kk }}</td>
                                    <td class="p-2">{{ $dosenRiib->pendidikan_terakhir }}</td>
                                    <td class="p-2">{{ $dosenRiib->tahun_masuk }}</td>
                                    <td class="p-2">{{ $dosenRiib->sedang_studi_lanjut ? 'Ya' : 'Tidak' }}</td>
                                    <td class="p-2">{{ $dosenRiib->nidn }}</td>
                                    <td class="p-2">{{ $dosenRiib->nip }}</td>
                                    <td class="p-2">{{ $dosenRiib->CoE }}</td>
                                    <td class="p-2">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('dosen-riib.edit', $dosenRiib) }}"
                                               class="text-blue-600 hover:underline">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('dosen-riib.destroy', $dosenRiib) }}"
                                                  onsubmit="return confirm('Hapus data dosen ini?')">
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
                                    <td colspan="14" class="p-4 text-center text-gray-500">
                                        Belum ada data dosen
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
