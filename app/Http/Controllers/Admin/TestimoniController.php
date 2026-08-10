<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TestimoniController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimoni::query()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('perusahaan', 'like', "%{$search}%")
                  ->orWhere('testimoni', 'like', "%{$search}%");
            });
        }

        $testimonis = $query->get();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $testimonis,
            ]);
        }

        return view('admin.pages.testimoni.index', compact('testimonis'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'testimoni' => 'required|string',
            'status' => 'required|in:published,draft',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('testimonis', 'public');
        }

        $testimoni = Testimoni::create($data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil ditambahkan!',
                'data' => $testimoni,
            ]);
        }

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function show($id)
    {
        $testimoni = Testimoni::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $testimoni,
        ]);
    }

    public function update(Request $request, $id)
    {
        $testimoni = Testimoni::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'testimoni' => 'required|string',
            'status' => 'required|in:published,draft',
            'foto' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($testimoni->foto && Storage::disk('public')->exists($testimoni->foto)) {
                Storage::disk('public')->delete($testimoni->foto);
            }
            $data['foto'] = $request->file('foto')->store('testimonis', 'public');
        }

        $testimoni->update($data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil diperbarui!',
                'data' => $testimoni,
            ]);
        }

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Request $request, Testimoni $testimoni)
    {
        if ($testimoni->foto && Storage::disk('public')->exists($testimoni->foto)) {
            Storage::disk('public')->delete($testimoni->foto);
        }
        $testimoni->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil dihapus!',
            ]);
        }

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus!');
    }
}
