<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karir;
use App\Models\Pelamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PelamarController extends Controller
{
    /**
     * Display a listing of applicants.
     */
    public function index(Request $request)
    {
        $query = Pelamar::query()->with('karir')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhere('posisi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        if ($request->filled('posisi') && $request->posisi !== 'Semua') {
            $query->where('posisi', $request->posisi);
        }

        $pelamars = $query->get();

        // Calculate KPI Stats
        $stats = [
            'total' => Pelamar::count(),
            'pending' => Pelamar::where('status', 'Pending')->count(),
            'proses' => Pelamar::whereIn('status', ['Review', 'Wawancara'])->count(),
            'diterima' => Pelamar::where('status', 'Diterima')->count(),
            'ditolak' => Pelamar::where('status', 'Ditolak')->count(),
        ];

        // List distinct positions for filter dropdown
        $positions = Pelamar::whereNotNull('posisi')->where('posisi', '!=', '')->distinct()->pluck('posisi');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'data' => $pelamars,
                'stats' => $stats,
                'positions' => $positions,
            ]);
        }

        return view('admin.pages.pelamar.index', compact('pelamars', 'stats', 'positions'));
    }

    /**
     * Display the specified applicant.
     */
    public function show($id)
    {
        $pelamar = Pelamar::with('karir')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $pelamar,
        ]);
    }

    /**
     * Update status and notes for the specified applicant.
     */
    public function update(Request $request, $id)
    {
        $pelamar = Pelamar::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Pending,Review,Wawancara,Diterima,Ditolak',
            'catatan_admin' => 'nullable|string',
        ]);

        $pelamar->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Status pelamar ' . $pelamar->nama . ' berhasil diperbarui!',
                'data' => $pelamar->fresh(),
            ]);
        }

        return redirect()->route('admin.pelamar.index')->with('success', 'Status pelamar berhasil diperbarui!');
    }

    /**
     * Remove the specified applicant from storage.
     */
    public function destroy(Request $request, $id)
    {
        $pelamar = Pelamar::findOrFail($id);

        // Delete CV file if exists
        if ($pelamar->file_cv) {
            if (Storage::disk('public')->exists($pelamar->file_cv)) {
                Storage::disk('public')->delete($pelamar->file_cv);
            } elseif (File::exists(public_path($pelamar->file_cv))) {
                File::delete(public_path($pelamar->file_cv));
            }
        }

        $nama = $pelamar->nama;
        $pelamar->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data pelamar ' . $nama . ' berhasil dihapus!',
            ]);
        }

        return redirect()->route('admin.pelamar.index')->with('success', 'Data pelamar berhasil dihapus!');
    }

    /**
     * Download or stream applicant CV
     */
    public function downloadCv($id)
    {
        $pelamar = Pelamar::findOrFail($id);

        if (!$pelamar->file_cv) {
            return back()->with('error', 'Berkas CV tidak ditemukan.');
        }

        if (Storage::disk('public')->exists($pelamar->file_cv)) {
            return Storage::disk('public')->download($pelamar->file_cv, 'CV_' . str_replace(' ', '_', $pelamar->nama) . '.pdf');
        }

        if (File::exists(public_path($pelamar->file_cv))) {
            return response()->download(public_path($pelamar->file_cv), 'CV_' . str_replace(' ', '_', $pelamar->nama) . '.pdf');
        }

        return back()->with('error', 'File CV fisik tidak ditemukan di server.');
    }
}
