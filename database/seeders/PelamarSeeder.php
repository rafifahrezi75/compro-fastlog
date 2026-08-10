<?php

namespace Database\Seeders;

use App\Models\Karir;
use App\Models\Pelamar;
use Illuminate\Database\Seeder;

class PelamarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karirOperational = Karir::where('nama_karir', 'like', '%Operational%')->first();
        $karirCustoms = Karir::where('nama_karir', 'like', '%Customs%')->first();
        $karirSales = Karir::where('nama_karir', 'like', '%Sales%')->first();
        $karirWarehouse = Karir::where('nama_karir', 'like', '%Warehouse%')->first();

        $dummyPelamars = [
            [
                'karir_id' => $karirOperational?->id,
                'posisi' => $karirOperational ? $karirOperational->nama_karir : 'Logistics Operational Staff',
                'nama' => 'Budi Pratama',
                'email' => 'budi.pratama@gmail.com',
                'telepon' => '081234567890',
                'file_cv' => 'pelamars/sample_cv_budi.pdf',
                'pesan' => 'Saya memiliki pengalaman 2 tahun di bidang operasional logistik pelabuhan Tanjung Perak dan menguasai sistem tracking kargo.',
                'status' => 'Pending',
                'catatan_admin' => null,
            ],
            [
                'karir_id' => $karirCustoms?->id,
                'posisi' => $karirCustoms ? $karirCustoms->nama_karir : 'Customs Clearance Specialist (PPJK)',
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@yahoo.com',
                'telepon' => '085712345678',
                'file_cv' => 'pelamars/sample_cv_siti.pdf',
                'pesan' => 'Telah memiliki sertifikasi resmi PPJK dari BPPK Kemenkeu dan aktif mengurus dokumen ekspor impor CEISA 4.0.',
                'status' => 'Review',
                'catatan_admin' => 'Kualifikasi sertifikat PPJK sangat cocok, jadwalkan tes teknis kepabeanan.',
            ],
            [
                'karir_id' => $karirSales?->id,
                'posisi' => $karirSales ? $karirSales->nama_karir : 'Sales Executive Freight Forwarding',
                'nama' => 'Rian Hidayat',
                'email' => 'rian.hidayat@outlook.com',
                'telepon' => '082198765432',
                'file_cv' => 'pelamars/sample_cv_rian.pdf',
                'pesan' => 'Berpengalaman 3 tahun sebagai B2B Account Executive freight forwarding dengan portofolio klien aktif di kawasan industri Jababeka.',
                'status' => 'Wawancara',
                'catatan_admin' => 'Undang interview user tanggal 15 Agustus 2026 pukul 10.00 WIB.',
            ],
            [
                'karir_id' => $karirWarehouse?->id,
                'posisi' => $karirWarehouse ? $karirWarehouse->nama_karir : 'Warehouse & Inventory Supervisor',
                'nama' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@gmail.com',
                'telepon' => '087811223344',
                'file_cv' => 'pelamars/sample_cv_ahmad.pdf',
                'pesan' => 'Menguasai WMS (Warehouse Management System), manajemen stok FIFO/LIFO, serta supervisi tim gudang 20+ orang.',
                'status' => 'Diterima',
                'catatan_admin' => 'Lolos seluruh rangkaian interview & medical checkup. Offering letter terkirim.',
            ],
        ];

        foreach ($dummyPelamars as $item) {
            Pelamar::updateOrCreate(
                ['email' => $item['email'], 'posisi' => $item['posisi']],
                $item
            );
        }
    }
}
