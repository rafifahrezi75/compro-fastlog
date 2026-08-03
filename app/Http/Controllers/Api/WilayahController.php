<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /**
     * Mengambil seluruh data 38 Provinsi di Indonesia
     */
    public function getProvinsi(): JsonResponse
    {
        $provinsi = Wilayah::provinsi()->get(['kode', 'nama']);

        return response()->json([
            'status' => 'success',
            'data' => $provinsi,
        ]);
    }

    /**
     * Mengambil daftar Kabupaten / Kota berdasarkan kode provinsi
     */
    public function getKabupatenKota(string $provinsiKode): JsonResponse
    {
        $kabupatenKota = Wilayah::kabupatenKota($provinsiKode)->get(['kode', 'nama']);

        return response()->json([
            'status' => 'success',
            'provinsi_kode' => $provinsiKode,
            'data' => $kabupatenKota,
        ]);
    }

    /**
     * Mengambil daftar Kecamatan berdasarkan kode kabupaten/kota
     */
    public function getKecamatan(string $kabupatenKode): JsonResponse
    {
        $kecamatan = Wilayah::kecamatan($kabupatenKode)->get(['kode', 'nama']);

        return response()->json([
            'status' => 'success',
            'kabupaten_kode' => $kabupatenKode,
            'data' => $kecamatan,
        ]);
    }

    /**
     * Pencarian wilayah berdasarkan kata kunci nama
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->query('q', '');

        if (empty($query)) {
            return response()->json([
                'status' => 'success',
                'data' => [],
            ]);
        }

        $results = Wilayah::where('nama', 'LIKE', '%' . $query . '%')
            ->limit(25)
            ->get(['kode', 'nama']);

        return response()->json([
            'status' => 'success',
            'query' => $query,
            'data' => $results,
        ]);
    }
}
