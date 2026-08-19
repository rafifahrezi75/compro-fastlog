<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infos = Info::latest()->get();
        return view('admin.pages.info.index', compact('infos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Info::count() > 0) {
            return redirect()->route('admin.infos.index')->with('error', 'Hanya diperbolehkan satu data informasi perusahaan.');
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kota' => 'required|string|max:255',
            'alamatLengkap' => 'required|string',
            'email' => 'required|email|max:255',
            'notelp' => 'required|string|max:255',
            'linkFacebook' => 'nullable|url',
            'linkInstagram' => 'nullable|url',
            'linkX' => 'nullable|url',
            'linkLinkedin' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('infos', 'public');
            $validated['logo'] = $path;
        }

        Info::create($validated);

        return redirect()->route('admin.infos.index')->with('success', 'Informasi perusahaan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $info = Info::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'kota' => 'required|string|max:255',
            'alamatLengkap' => 'required|string',
            'email' => 'required|email|max:255',
            'notelp' => 'required|string|max:255',
            'linkFacebook' => 'nullable|url',
            'linkInstagram' => 'nullable|url',
            'linkX' => 'nullable|url',
            'linkLinkedin' => 'nullable|url',
        ]);

        if ($request->hasFile('logo')) {
            if ($info->logo && Storage::disk('public')->exists($info->logo)) {
                Storage::disk('public')->delete($info->logo);
            }
            $path = $request->file('logo')->store('infos', 'public');
            $validated['logo'] = $path;
        }

        $info->update($validated);

        return redirect()->route('admin.infos.index')->with('success', 'Informasi perusahaan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $info = Info::findOrFail($id);
        
        if ($info->logo && Storage::disk('public')->exists($info->logo)) {
            Storage::disk('public')->delete($info->logo);
        }
        
        $info->delete();

        return redirect()->route('admin.infos.index')->with('success', 'Informasi perusahaan berhasil dihapus.');
    }
}
