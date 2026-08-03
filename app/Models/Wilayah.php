<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = false;

    protected $fillable = [
        'kode',
        'nama',
    ];

    /**
     * Scope untuk mendapatkan data Provinsi (Panjang kode = 2)
     */
    public function scopeProvinsi($query)
    {
        return $query->whereRaw('LENGTH(kode) = 2')->orderBy('nama', 'asc');
    }

    /**
     * Scope untuk mendapatkan data Kabupaten / Kota (Panjang kode = 5)
     * Format: XX.YY
     */
    public function scopeKabupatenKota($query, ?string $provinsiKode = null)
    {
        $q = $query->whereRaw('LENGTH(kode) = 5');

        if ($provinsiKode) {
            $q->where('kode', 'LIKE', $provinsiKode . '.%');
        }

        return $q->orderBy('nama', 'asc');
    }

    /**
     * Scope untuk mendapatkan data Kecamatan (Panjang kode = 8)
     * Format: XX.YY.ZZ
     */
    public function scopeKecamatan($query, ?string $kabupatenKode = null)
    {
        $q = $query->whereRaw('LENGTH(kode) = 8');

        if ($kabupatenKode) {
            $q->where('kode', 'LIKE', $kabupatenKode . '.%');
        }

        return $q->orderBy('nama', 'asc');
    }

    /**
     * Scope untuk mendapatkan data Kelurahan / Desa (Panjang kode = 13)
     * Format: XX.YY.ZZ.AAAA
     */
    public function scopeKelurahanDesa($query, ?string $kecamatanKode = null)
    {
        $q = $query->whereRaw('LENGTH(kode) = 13');

        if ($kecamatanKode) {
            $q->where('kode', 'LIKE', $kecamatanKode . '.%');
        }

        return $q->orderBy('nama', 'asc');
    }

    /**
     * Accessor untuk mengetahui tingkat wilayah
     */
    public function getTingkatAttribute(): string
    {
        $len = strlen($this->kode ?? '');
        return match ($len) {
            2 => 'Provinsi',
            5 => 'Kabupaten/Kota',
            8 => 'Kecamatan',
            13 => 'Kelurahan/Desa',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Accessor untuk mendapatkan kode induk (parent)
     */
    public function getParentKodeAttribute(): ?string
    {
        $len = strlen($this->kode ?? '');
        return match ($len) {
            5 => substr($this->kode, 0, 2),
            8 => substr($this->kode, 0, 5),
            13 => substr($this->kode, 0, 8),
            default => null,
        };
    }

    /**
     * Mendapatkan data parent wilayah jika ada
     */
    public function parent()
    {
        return $this->belongsTo(Wilayah::class, 'parent_kode', 'kode');
    }
}
