<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::query()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $gallerys = $query->get();

        // Calculate KPI Statistics
        $stats = [
            'total' => Gallery::count(),
            'published' => Gallery::where('status', 'published')->count(),
            'draft' => Gallery::where('status', 'draft')->count(),
        ];

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $gallerys,
                'stats' => $stats,
            ]);
        }

        return view('admin.pages.gallery.index', compact('gallerys', 'stats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'nullable|in:published,draft,archived',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
        ]);

        // Auto-generate slug from judul
        $baseSlug = Str::slug($validated['judul']);
        $slug = $baseSlug;
        $counter = 1;
        while (Gallery::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-" . $counter++;
        }

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $uploadDir = public_path('uploads/gallery');
            if (!File::exists($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }

            $filename = $image->hashName();
            $image->move($uploadDir, $filename);
            $imagePath = 'uploads/gallery/' . $filename;
        }

        $gallery = Gallery::create([
            'judul' => $validated['judul'],
            'slug' => $slug,
            'gambar' => $imagePath,
            'deskripsi' => $validated['deskripsi'],
            'status' => $validated['status'] ?? 'published',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery berhasil diterbitkan!',
                'data' => $gallery,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil diterbitkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $gallery,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'nullable|in:published,draft,archived',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
        ]);

        // Auto-generate slug from judul if title changed or requested
        $baseSlug = Str::slug($validated['judul']);
        $slug = $baseSlug;
        $counter = 1;
        while (Gallery::where('slug', $slug)->where('id', '!=', $gallery->id)->exists()) {
            $slug = "{$baseSlug}-" . $counter++;
        }

        $imagePath = $gallery->gambar;
        if ($request->hasFile('gambar')) {
            // Delete previous image if exists in uploads/gallery
            if ($imagePath && File::exists(public_path($imagePath)) && str_starts_with($imagePath, 'uploads/gallery/')) {
                File::delete(public_path($imagePath));
            }

            $image = $request->file('gambar');
            $uploadDir = public_path('uploads/gallery');
            if (!File::exists($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }

            $filename = $image->hashName();
            $image->move($uploadDir, $filename);
            $imagePath = 'uploads/gallery/' . $filename;
        }

        $gallery->update([
            'judul' => $validated['judul'],
            'slug' => $slug,
            'gambar' => $imagePath,
            'deskripsi' => $validated['deskripsi'],
            'status' => $validated['status'] ?? $gallery->status,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery berhasil diperbarui!',
                'data' => $gallery,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete physical file if exists
        if ($gallery->gambar && File::exists(public_path($gallery->gambar)) && str_starts_with($gallery->gambar, 'uploads/gallery/')) {
            File::delete(public_path($gallery->gambar));
        }

        $gallery->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Gallery berhasil dihapus!',
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil dihapus!');
    }
}
