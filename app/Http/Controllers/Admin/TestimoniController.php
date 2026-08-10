<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'testimoni' => 'required|string',
            'status' => 'required|in:published,draft',
        ]);

        $testimoni = Testimoni::create($validated);

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

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'testimoni' => 'required|string',
            'status' => 'required|in:published,draft',
        ]);

        $testimoni->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Testimoni berhasil diperbarui!',
                'data' => $testimoni,
            ]);
        }

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Request $request, $id)
    {
        $testimoni = Testimoni::findOrFail($id);
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
