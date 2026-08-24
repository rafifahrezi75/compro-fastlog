<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $query = Layanan::query()->orderBy('urutan')->orderBy('id');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('deskripsi_singkat', 'like', "%{$search}%");
            });
        }

        $layanans = $query->get();

        return view('admin.pages.layanan.index', compact('layanans'));
    }

    public function create()
    {
        $mode = 'create';

        return view('admin.pages.layanan.form', compact('mode'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['slug'] = $this->makeSlug($request, $data['nama']);
        $data['fitur'] = $this->parseFitur($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('layanans', 'public');
        }

        $layanan = Layanan::create($data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Layanan berhasil ditambahkan!',
                'data'    => $layanan,
            ], 201);
        }

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    public function show(Layanan $layanan)
    {
        return view('admin.pages.layanan.show', compact('layanan'));
    }

    public function edit(Layanan $layanan)
    {
        $mode = 'edit';

        return view('admin.pages.layanan.form', compact('mode', 'layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $data = $this->validateData($request);

        $data['slug']  = $this->makeSlug($request, $data['nama'], $layanan);
        $data['fitur'] = $this->parseFitur($request);

        if ($request->hasFile('gambar')) {
            if ($layanan->gambar && Storage::disk('public')->exists($layanan->gambar)) {
                Storage::disk('public')->delete($layanan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('layanans', 'public');
        }

        $layanan->update($data);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Layanan berhasil diperbarui!',
                'data'    => $layanan->fresh(),
            ]);
        }

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Request $request, Layanan $layanan)
    {
        if ($layanan->gambar && Storage::disk('public')->exists($layanan->gambar)) {
            Storage::disk('public')->delete($layanan->gambar);
        }

        $layanan->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Layanan berhasil dihapus!',
            ]);
        }

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'nama'              => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'deskripsi_lengkap' => 'required|string',
            'ikon'              => 'nullable|string|max:65535',
            'status'            => 'required|in:aktif,nonaktif',
            'urutan'            => 'nullable|integer|min:0',
            'gambar'            => 'nullable|image|max:2048',
        ]);
    }

    private function makeSlug(Request $request, string $nama, ?Layanan $layanan = null): string
    {
        $base = Str::slug($request->input('slug') ?: $nama);
        $slug = $base;
        $i = 1;

        while (Layanan::where('slug', $slug)->when($layanan, fn ($q) => $q->whereKeyNot($layanan->getKey()))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    private function parseFitur(Request $request): array
    {
        $raw = $request->input('fitur');

        if (is_array($raw)) {
            $raw = implode("\n", $raw);
        }

        return array_values(array_filter(array_map('trim', explode("\n", (string) $raw)), fn ($f) => $f !== ''));
    }
}
