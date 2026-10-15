<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('admin.ruangan.index', compact('ruangan'));
    }

    public function create()
    {
        return view('admin.ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'gedung' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        Ruangan::create($request->only(['nama_ruangan', 'gedung', 'kapasitas', 'fasilitas', 'status']));

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'gedung' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->only(['nama_ruangan', 'gedung', 'kapasitas', 'fasilitas', 'status']));

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}
