<?php

namespace App\Http\Controllers;

use App\Models\DosenRiib;
use Illuminate\Http\Request;

class DosenRiibController extends Controller
{
    public function index()
    {
        $dosenRiibs = DosenRiib::orderBy('id', 'desc')->get();

        return view('dosen-riib.index', compact('dosenRiibs'));
    }

    public function store(Request $request)
    {
        DosenRiib::create($this->validatedData($request));

        return redirect()->route('dosen-riib.index')
            ->with('success', 'Data dosen berhasil ditambahkan');
    }

    public function edit(DosenRiib $dosenRiib)
    {
        return view('dosen-riib.edit', compact('dosenRiib'));
    }

    public function update(Request $request, DosenRiib $dosenRiib)
    {
        $dosenRiib->update($this->validatedData($request));

        return redirect()->route('dosen-riib.index')
            ->with('success', 'Data dosen berhasil diperbarui');
    }

    public function destroy(DosenRiib $dosenRiib)
    {
        $dosenRiib->delete();

        return redirect()->route('dosen-riib.index')
            ->with('success', 'Data dosen berhasil dihapus');
    }

    private function validatedData(Request $request): array
    {
        $validated = $request->validate([
            'kode_dosen' => 'nullable|string|max:10',
            'nama_dosen' => 'nullable|string|max:150',
            'prodi' => 'nullable|string|max:100',
            'kk' => 'nullable|string|max:10',
            'jad' => 'nullable|in:NJFA,AA,L,LK,GB',
            'sub_kk' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:10',
            'tahun_masuk' => 'nullable|integer',
            'sedang_studi_lanjut' => 'nullable|boolean',
            'nidn' => 'nullable|string|max:20',
            'nip' => 'nullable|string|max:20',
            'CoE' => 'nullable|string|max:100',
        ]);

        $validated['sedang_studi_lanjut'] = $request->boolean('sedang_studi_lanjut');

        return $validated;
    }
}
