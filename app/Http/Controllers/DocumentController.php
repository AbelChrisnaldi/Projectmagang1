<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();

        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return redirect()->route('documents.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|url|max:2048',
        ]);

        Document::create($validated);

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil ditambahkan');
    }

    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|url|max:2048',
        ]);

        $document->update($validated);

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil diperbarui');
    }

    public function destroy(Document $document)
    {
        $document->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil dihapus');
    }
}
