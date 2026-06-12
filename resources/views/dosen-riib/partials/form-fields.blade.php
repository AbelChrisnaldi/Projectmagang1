@php
    $dosenRiib = $dosenRiib ?? null;
    $jadOptions = ['NJFA', 'AA', 'L', 'LK', 'GB'];
    $textFields = [
        ['name' => 'kode_dosen', 'label' => 'Kode Dosen', 'type' => 'text', 'maxlength' => 10],
        ['name' => 'nama_dosen', 'label' => 'Nama Dosen', 'type' => 'text', 'maxlength' => 150],
        ['name' => 'prodi', 'label' => 'Prodi', 'type' => 'text', 'maxlength' => 100],
        ['name' => 'kk', 'label' => 'KK', 'type' => 'text', 'maxlength' => 10],
        ['name' => 'sub_kk', 'label' => 'Sub KK', 'type' => 'text', 'maxlength' => 10],
        ['name' => 'pendidikan_terakhir', 'label' => 'Pendidikan Terakhir', 'type' => 'text', 'maxlength' => 10],
        ['name' => 'tahun_masuk', 'label' => 'Tahun Masuk', 'type' => 'number', 'maxlength' => null],
        ['name' => 'nidn', 'label' => 'NIDN', 'type' => 'text', 'maxlength' => 20],
        ['name' => 'nip', 'label' => 'NIP', 'type' => 'text', 'maxlength' => 20],
        ['name' => 'CoE', 'label' => 'CoE', 'type' => 'text', 'maxlength' => 100],
    ];
    $selectedJad = old('jad', $dosenRiib->jad ?? '');
    $selectedStudiLanjut = old('sedang_studi_lanjut', isset($dosenRiib) ? (int) $dosenRiib->sedang_studi_lanjut : 0);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($textFields as $field)
        <div>
            <label for="{{ $field['name'] }}" class="block text-sm font-medium text-gray-700 mb-1">
                {{ $field['label'] }}
            </label>
            <input id="{{ $field['name'] }}"
                   type="{{ $field['type'] }}"
                   name="{{ $field['name'] }}"
                   value="{{ old($field['name'], $dosenRiib?->{$field['name']} ?? '') }}"
                   @if ($field['maxlength']) maxlength="{{ $field['maxlength'] }}" @endif
                   class="border rounded px-3 py-2 w-full">
            @error($field['name'])
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
        </div>
    @endforeach

    <div>
        <label for="jad" class="block text-sm font-medium text-gray-700 mb-1">JAD</label>
        <select id="jad" name="jad" class="border rounded px-3 py-2 w-full">
            <option value="">Pilih JAD</option>
            @foreach ($jadOptions as $jad)
                <option value="{{ $jad }}" @selected($selectedJad === $jad)>
                    {{ $jad }}
                </option>
            @endforeach
        </select>
        @error('jad')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="sedang_studi_lanjut" class="block text-sm font-medium text-gray-700 mb-1">Sedang Studi Lanjut</label>
        <select id="sedang_studi_lanjut" name="sedang_studi_lanjut" class="border rounded px-3 py-2 w-full">
            <option value="0" @selected((string) $selectedStudiLanjut === '0')>Tidak</option>
            <option value="1" @selected((string) $selectedStudiLanjut === '1')>Ya</option>
        </select>
        @error('sedang_studi_lanjut')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
