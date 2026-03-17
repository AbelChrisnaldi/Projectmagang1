<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();

        return view('dashboard', compact('kegiatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string|max:255',
            'outline' => 'nullable|string',
            'link_slide' => 'nullable|url',
            'link_notulensi' => 'nullable|url',
        ]);

        Kegiatan::create($request->only([
            'tanggal',
            'kegiatan',
            'outline',
            'link_slide',
            'link_notulensi',
        ]));

        return redirect()->route('dashboard')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Kegiatan berhasil dihapus');
    }
}
