<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Kegiatan;

class PublicController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();
        $documents = Document::latest()->get();

        return view('welcome', compact('kegiatans', 'documents'));
    }
}
