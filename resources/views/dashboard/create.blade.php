@extends('layouts.dashboard-layout')

@section('content')
<h1 class="text-xl font-semibold mb-4">Input Kegiatan Akademik</h1>

<form method="POST" action="{{ route('kegiatan.store') }}"
      class="bg-white p-6 rounded shadow space-y-4">
    @csrf

    <input type="date" name="tanggal" class="w-full border p-2 rounded" required>

    <input type="text" name="kegiatan" placeholder="Nama Kegiatan"
           class="w-full border p-2 rounded" required>

    <textarea name="outline" rows="4" placeholder="Outline"
              class="w-full border p-2 rounded"></textarea>

    <input type="url" name="link_slide" placeholder="Link Slide"
           class="w-full border p-2 rounded">

    <input type="url" name="link_notulensi" placeholder="Link Notulensi"
           class="w-full border p-2 rounded">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Simpan
    </button>
</form>
@endsection
