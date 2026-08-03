<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::query()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('sumber', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('sumber') && $request->sumber !== 'all') {
            $query->where('sumber', $request->sumber);
        }

        $beritas = $query->get();

        // Calculate KPI Statistics
        $stats = [
            'total' => Berita::count(),
            'published' => Berita::where('status', 'published')->count(),
            'draft' => Berita::where('status', 'draft')->count(),
            'total_sumber' => Berita::whereNotNull('sumber')->where('sumber', '!=', '')->distinct('sumber')->count('sumber'),
        ];

        // List unique sources for dropdown filter
        $sources = Berita::whereNotNull('sumber')->where('sumber', '!=', '')->distinct()->pluck('sumber');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $beritas,
                'stats' => $stats,
                'sources' => $sources,
            ]);
        }

        return view('admin.pages.berita.index', compact('beritas', 'stats', 'sources'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'sumber' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'status' => 'nullable|in:published,draft,archived',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
        ]);

        // Auto-generate slug from judul
        $baseSlug = Str::slug($validated['judul']);
        $slug = $baseSlug;
        $counter = 1;
        while (Berita::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-" . $counter++;
        }

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $uploadDir = public_path('uploads/berita');
            if (!File::exists($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }

            $filename = $image->hashName();
            $image->move($uploadDir, $filename);
            $imagePath = 'uploads/berita/' . $filename;
        }

        $berita = Berita::create([
            'judul' => $validated['judul'],
            'slug' => $slug,
            'gambar' => $imagePath,
            'isi' => $validated['isi'],
            'sumber' => $validated['sumber'] ?? null,
            'status' => $validated['status'] ?? 'published',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil diterbitkan!',
                'data' => $berita,
            ]);
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $berita = Berita::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $berita,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'sumber' => 'nullable|string|max:255',
            'isi' => 'required|string',
            'status' => 'nullable|in:published,draft,archived',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
        ]);

        // Auto-generate slug from judul if title changed or requested
        $baseSlug = Str::slug($validated['judul']);
        $slug = $baseSlug;
        $counter = 1;
        while (Berita::where('slug', $slug)->where('id', '!=', $berita->id)->exists()) {
            $slug = "{$baseSlug}-" . $counter++;
        }

        $imagePath = $berita->gambar;
        if ($request->hasFile('gambar')) {
            // Delete previous image if exists in uploads/berita
            if ($imagePath && File::exists(public_path($imagePath)) && str_starts_with($imagePath, 'uploads/berita/')) {
                File::delete(public_path($imagePath));
            }

            $image = $request->file('gambar');
            $uploadDir = public_path('uploads/berita');
            if (!File::exists($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }

            $filename = $image->hashName();
            $image->move($uploadDir, $filename);
            $imagePath = 'uploads/berita/' . $filename;
        }

        $berita->update([
            'judul' => $validated['judul'],
            'slug' => $slug,
            'gambar' => $imagePath,
            'isi' => $validated['isi'],
            'sumber' => $validated['sumber'] ?? null,
            'status' => $validated['status'] ?? $berita->status,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil diperbarui!',
                'data' => $berita,
            ]);
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        // Delete physical file if exists
        if ($berita->gambar && File::exists(public_path($berita->gambar)) && str_starts_with($berita->gambar, 'uploads/berita/')) {
            File::delete(public_path($berita->gambar));
        }

        $berita->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berita berhasil dihapus!',
            ]);
        }

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
