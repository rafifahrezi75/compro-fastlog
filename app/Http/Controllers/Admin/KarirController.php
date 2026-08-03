<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karir;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KarirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Karir::query()->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_karir', 'like', "%{$search}%")
                  ->orWhere('kota', 'like', "%{$search}%")
                  ->orWhere('provinsi', 'like', "%{$search}%")
                  ->orWhere('negara', 'like', "%{$search}%")
                  ->orWhere('alamat_detail', 'like', "%{$search}%")
                  ->orWhere('departemen', 'like', "%{$search}%")
                  ->orWhere('tipe_pekerjaan', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('departemen') && $request->departemen !== 'Semua') {
            $query->where('departemen', $request->departemen);
        }

        if ($request->filled('provinsi') && $request->provinsi !== 'Semua') {
            $query->where('provinsi', $request->provinsi);
        }

        $karirs = $query->get();

        // Calculate KPI Statistics
        $stats = [
            'total' => Karir::count(),
            'aktif' => Karir::where('status', 'Aktif')->count(),
            'tutup' => Karir::where('status', 'Tutup')->count(),
            'total_kota' => Karir::whereNotNull('kota')->where('kota', '!=', '')->distinct('kota')->count('kota'),
            'total_departemen' => Karir::whereNotNull('departemen')->where('departemen', '!=', '')->distinct('departemen')->count('departemen'),
        ];

        // List distinct departments and provinces for filter options
        $departments = Karir::whereNotNull('departemen')->where('departemen', '!=', '')->distinct()->pluck('departemen');
        $provinces = Karir::whereNotNull('provinsi')->where('provinsi', '!=', '')->distinct()->pluck('provinsi');

        // Master Wilayah Indonesia (38 Provinsi & Map Kab/Kota per Provinsi)
        $masterProvinsiList = \App\Models\Wilayah::provinsi()->orderBy('nama')->get(['kode', 'nama']);
        
        // Group all cities by province code
        $allCities = \App\Models\Wilayah::kabupatenKota()->orderBy('nama')->get(['kode', 'nama']);
        $masterKotaMap = [];
        foreach ($allCities as $city) {
            $provKode = substr($city->kode, 0, 2);
            $masterKotaMap[$provKode][] = $city->nama;
        }

        $masterProvinsi = $masterProvinsiList->pluck('nama');
        $masterKota = $allCities->pluck('nama');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $karirs,
                'stats' => $stats,
                'departments' => $departments,
                'provinces' => $provinces,
                'master_provinsi_list' => $masterProvinsiList,
                'master_kota_map' => $masterKotaMap,
            ]);
        }

        return view('admin.pages.karir.index', compact(
            'karirs',
            'stats',
            'departments',
            'provinces',
            'masterProvinsiList',
            'masterKotaMap',
            'masterProvinsi',
            'masterKota'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_karir' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'negara' => 'nullable|string|max:255',
            'alamat_detail' => 'required|string',
            'tipe_pekerjaan' => 'nullable|string|max:100',
            'departemen' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'kualifikasi' => 'nullable',
            'status' => 'nullable|in:Aktif,Tutup,Draft',
        ]);

        // Process kualifikasi points
        $kualifikasiVal = $request->kualifikasi;
        if (is_array($kualifikasiVal)) {
            $cleanedPoints = array_values(array_filter(array_map('trim', $kualifikasiVal)));
            $kualifikasiVal = json_encode($cleanedPoints, JSON_UNESCAPED_UNICODE);
        }

        // Auto-generate slug from nama_karir
        $baseSlug = Str::slug($validated['nama_karir']);
        $slug = $baseSlug;
        $counter = 1;
        while (Karir::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-" . $counter++;
        }

        $karir = Karir::create([
            'nama_karir' => $validated['nama_karir'],
            'slug' => $slug,
            'kota' => $validated['kota'],
            'provinsi' => $validated['provinsi'],
            'negara' => $validated['negara'] ?: 'Indonesia',
            'alamat_detail' => $validated['alamat_detail'],
            'tipe_pekerjaan' => $validated['tipe_pekerjaan'] ?: 'Full-Time',
            'departemen' => $validated['departemen'] ?: 'Operations',
            'deskripsi' => $validated['deskripsi'] ?? null,
            'kualifikasi' => $kualifikasiVal ?? null,
            'status' => $validated['status'] ?: 'Aktif',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data karir berhasil ditambahkan!',
                'data' => $karir,
            ]);
        }

        return redirect()->route('admin.karir.index')->with('success', 'Data karir berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $karir = Karir::findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $karir,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $karir = Karir::findOrFail($id);

        $validated = $request->validate([
            'nama_karir' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'negara' => 'nullable|string|max:255',
            'alamat_detail' => 'required|string',
            'tipe_pekerjaan' => 'nullable|string|max:100',
            'departemen' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'kualifikasi' => 'nullable',
            'status' => 'nullable|in:Aktif,Tutup,Draft',
        ]);

        // Process kualifikasi points
        $kualifikasiVal = $request->kualifikasi;
        if (is_array($kualifikasiVal)) {
            $cleanedPoints = array_values(array_filter(array_map('trim', $kualifikasiVal)));
            $kualifikasiVal = json_encode($cleanedPoints, JSON_UNESCAPED_UNICODE);
        }

        // Auto-generate slug from nama_karir if title changed
        $baseSlug = Str::slug($validated['nama_karir']);
        $slug = $baseSlug;
        $counter = 1;
        while (Karir::where('slug', $slug)->where('id', '!=', $karir->id)->exists()) {
            $slug = "{$baseSlug}-" . $counter++;
        }

        $karir->update([
            'nama_karir' => $validated['nama_karir'],
            'slug' => $slug,
            'kota' => $validated['kota'],
            'provinsi' => $validated['provinsi'],
            'negara' => $validated['negara'] ?: 'Indonesia',
            'alamat_detail' => $validated['alamat_detail'],
            'tipe_pekerjaan' => $validated['tipe_pekerjaan'] ?: 'Full-Time',
            'departemen' => $validated['departemen'] ?: 'Operations',
            'deskripsi' => $validated['deskripsi'] ?? null,
            'kualifikasi' => $kualifikasiVal ?? null,
            'status' => $validated['status'] ?: 'Aktif',
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data karir berhasil diperbarui!',
                'data' => $karir,
            ]);
        }

        return redirect()->route('admin.karir.index')->with('success', 'Data karir berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $karir = Karir::findOrFail($id);
        $namaKarir = $karir->nama_karir;
        $karir->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => "Data karir '{$namaKarir}' berhasil dihapus!",
            ]);
        }

        return redirect()->route('admin.karir.index')->with('success', "Data karir '{$namaKarir}' berhasil dihapus!");
    }
}
