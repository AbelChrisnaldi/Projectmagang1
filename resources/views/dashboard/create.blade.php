@extends('layouts.dashboard-layout')

@section('content')
<h1 class="text-xl font-semibold mb-4">Input Kegiatan Akademik</h1>

<form method="POST" action="{{ route('kegiatan.store') }}"
      class="bg-white p-6 rounded shadow space-y-4">
    @csrf

    <div>
        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
        <input id="tanggal" type="date" name="tanggal" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label for="kegiatan" class="block text-sm font-medium text-gray-700 mb-1">Nama Kegiatan</label>
        <input id="kegiatan" type="text" name="kegiatan"
               class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label for="outline" class="block text-sm font-medium text-gray-700 mb-1">Outline</label>
        <textarea id="outline" name="outline" rows="4"
                  class="w-full border p-2 rounded"></textarea>
    </div>

    <div>
        <label for="link_slide" class="block text-sm font-medium text-gray-700 mb-1">Link Slide</label>
        <input id="link_slide" type="url" name="link_slide"
               class="w-full border p-2 rounded">
    </div>

    <div>
        <label for="link_notulensi" class="block text-sm font-medium text-gray-700 mb-1">Link Notulensi</label>
        <input id="link_notulensi" type="url" name="link_notulensi"
               class="w-full border p-2 rounded">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
@endsection
