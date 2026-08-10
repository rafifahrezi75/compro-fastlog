<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marketing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarketingController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Marketing::query()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('divisi', 'like', "%{$search}%")
                  ->orWhere('no_wa', 'like', "%{$search}%");
            });
        }

        $marketings = $query->get();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $marketings,
            ]);
        }

        return view('admin.pages.marketing.index', compact('marketings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'divisi' => 'nullable|string|max:255',
            'no_wa' => 'required|string|max:50',
            'status' => 'required|in:online,offline',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('marketings', 'public');
        }

        $marketing = \App\Models\Marketing::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Marketing berhasil ditambahkan!',
                'data' => $marketing,
            ]);
        }

        return redirect()->route('admin.marketing.index')->with('success', 'Marketing berhasil ditambahkan!');
    }

    public function show($id)
    {
        $marketing = \App\Models\Marketing::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $marketing,
        ]);
    }

    public function update(Request $request, $id)
    {
        $marketing = \App\Models\Marketing::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'divisi' => 'nullable|string|max:255',
            'no_wa' => 'required|string|max:50',
            'status' => 'required|in:online,offline',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($marketing->foto) {
                Storage::disk('public')->delete($marketing->foto);
            }
            $validated['foto'] = $request->file('foto')->store('marketings', 'public');
        }

        $marketing->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Marketing berhasil diperbarui!',
                'data' => $marketing,
            ]);
        }

        return redirect()->route('admin.marketing.index')->with('success', 'Marketing berhasil diperbarui!');
    }

    public function destroy(Request $request, $id)
    {
        $marketing = \App\Models\Marketing::findOrFail($id);
        
        if ($marketing->foto) {
            Storage::disk('public')->delete($marketing->foto);
        }
        
        $marketing->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Marketing berhasil dihapus!',
            ]);
        }

        return redirect()->route('admin.marketing.index')->with('success', 'Marketing berhasil dihapus!');
    }
}
