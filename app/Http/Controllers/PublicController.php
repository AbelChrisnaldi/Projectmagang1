<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class PublicController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();

        return view('welcome', compact('kegiatans'));
    }
}
