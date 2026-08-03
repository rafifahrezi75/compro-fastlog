<?php

namespace Database\Seeders;

use App\Models\Karir;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KarirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyKarirs = [
            [
                'nama_karir' => 'Logistics Operational Staff',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Gedung Fastlog Hub Perak, Jl. Tanjung Perak Timur No. 88, Pabean Cantian, Kota Surabaya 60165',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Operations',
                'deskripsi' => 'Bertanggung jawab dalam mengawasi operasional harian pengiriman barang kargo darat dan laut, koordinasi armada truk dan kontainer, serta memastikan jadwal pengiriman tepat waktu.',
                'kualifikasi' => "• Pendidikan min. D3/S1 Manajemen Logistik / Transportasi / Semua Jurusan\n• Pengalaman minimal 1 tahun di industri logistik / freight forwarding\n• Mampu mengoperasikan sistem ERP Logistik & Ms. Excel\n• Komunikatif, teliti, dan siap bekerja shift jika dibutuhkan",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Customs Clearance Specialist (PPJK)',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Kompleks Pergudangan Margomulyo Indah Blok C-12, Tandes, Kota Surabaya 60186',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Import & Export',
                'deskripsi' => 'Mengurus dokumen kepabeanan impor/ekspor (PIB/PEB), koordinasi jalur merah/kuning/hijau dengan Bea Cukai, serta memastikan kepatuhan regulasi kepabeanan.',
                'kualifikasi' => "• Memiliki Sertifikat Ahli Kepabeanan (PPJK) resmi dari BPPK Kemenkeu\n• Pengalaman kerja min. 2 tahun di bidang customs clearance\n• Memahami sistem CEISA 4.0 Bea Cukai\n• Memiliki relasi yang baik dengan otoritas kepelabuhanan",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Sales Executive Freight Forwarding',
                'kota' => 'Jakarta Utara',
                'provinsi' => 'DKI Jakarta',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Menara Maritim Tower Lt. 15, Jl. Yos Sudarso No. 45, Tanjung Priok, Jakarta Utara 14320',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Sales & Marketing',
                'deskripsi' => 'Mencari klien korporat baru untuk layanan Sea Freight & Air Freight internasional, menangani penawaran harga (quotation), dan menjaga hubungan jangka panjang dengan klien B2B.',
                'kualifikasi' => "• Pendidikan minimal S1 segala jurusan\n• Pengalaman min. 2 tahun sebagai Sales/B2B Account Executive di Freight Forwarding\n• Memiliki portofolio klien aktif di sektor manufaktur/ekspor-impor\n• Fasih berbahasa Inggris lisan dan tulisan",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Warehouse & Inventory Supervisor',
                'kota' => 'Bekasi',
                'provinsi' => 'Jawa Barat',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Kawasan Industri GIIC Cikarang Pusat, Blok AB-09, Kabupaten Bekasi, Jawa Barat 17530',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Warehouse & Fleet',
                'deskripsi' => 'Memimpin tim gudang dalam inbound/outbound material, stock opname periodik, optimasi layout racking, dan penerapan standar K3 / 5R di warehouse seluas 15.000 m2.',
                'kualifikasi' => "• Pengalaman min. 3 tahun sebagai Warehouse Supervisor\n• Menguasai Warehouse Management System (WMS) dan barcode scanning\n• Memiliki jiwa leadership yang kuat dan terbiasa memimpin tim 30+ personil\n• Memiliki sertifikat K3 Umum menjadi nilai plus",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Fleet Maintenance & Mechanic Leader',
                'kota' => 'Semarang',
                'provinsi' => 'Jawa Tengah',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Pool Armada Fastlog Krapyak, Jl. Siliwangi No. 210, Semarang Barat, Kota Semarang 50146',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Warehouse & Fleet',
                'deskripsi' => 'Mengawasi jadwal perawatan berkala, perbaikan mesin truk trailer (Hino, Scania, Isuzu Giga), kontrol pemakaian suku cadang, dan uji kelayakan KIR armada.',
                'kualifikasi' => "• Pendidikan min. SMK Teknik Mesin / Otomotif atau D3 Teknik\n• Pengalaman min. 3 tahun dalam perbaikan heavy duty truck / trailer\n• Mampu melakukan troubleshooting electrical dan sistem pengereman angin\n• Memiliki SIM B2 Umum diutamakan",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Cold Chain Quality Control Officer',
                'kota' => 'Denpasar',
                'provinsi' => 'Bali',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Fastlog Cold Hub Benoa, Jl. Raya Pelabuhan Benoa No. 18, Denpasar Selatan, Kota Denpasar 80222',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Operations',
                'deskripsi' => 'Memastikan integritas rantai dingin (cold chain) untuk pengiriman kargo seafood, daging beku, dan farmasi dari titik muat hingga tujuan akhir.',
                'kualifikasi' => "• Pendidikan min. D3/S1 Teknologi Pangan / Biologi / Manajemen Logistik\n• Pengalaman min. 1 tahun di penanganan reefer container / cold storage\n• Memahami standar HACCP dan GDP (Good Distribution Practice)\n• Teliti dalam pencatatan logger suhu digital",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Air Freight Operations Specialist',
                'kota' => 'Tangerang',
                'provinsi' => 'Banten',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Area Kargo Bandara Internasional Soekarno-Hatta, Gedung 530 Lt. 2, Kota Tangerang 15126',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Operations',
                'deskripsi' => 'Menangani pemesanan ruang kargo udara maskapai penerbangan, pembuatan Air Waybill (AWB), build-up ULD pallet kargo, dan handling dangerous goods sesuai aturan IATA.',
                'kualifikasi' => "• Pengalaman min. 2 tahun di Air Cargo handling\n• Memiliki Basic Cargo Certificate / Dangerous Goods (DG) Type A/B dari IATA\n• Terbiasa bekerja dengan deadline ketat dan waktu loading malam/dini hari\n• Komunikatif dan teliti",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'IT Logistics Software Engineer (Fullstack)',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Fastlog Tech Center, Jl. Pemuda No. 108, Genteng, Kota Surabaya 60271',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'IT & Technology',
                'deskripsi' => 'Mengembangkan dan memelihara aplikasi web ERP Logistik, integrasi API GPS tracking, sistem billing otomatis, dan mobile app untuk pengemudi armada.',
                'kualifikasi' => "• Pendidikan S1 Teknik Informatika / Sistem Informasi / Ilmu Komputer\n• Mahir PHP (Laravel), JavaScript (Vue/Alpine/React), MySQL, dan REST API\n• Berpengalaman dalam optimasi database query kargo bervolume tinggi\n• Familiar dengan Git workflow dan Docker",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Branch Operational Manager (Batam)',
                'kota' => 'Batam',
                'provinsi' => 'Kepulauan Riau',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Batam Logistics Hub, Kawasan Industri Batu Ampar Kav. 7, Kota Batam 29432',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Operations',
                'deskripsi' => 'Bertanggung jawab penuh atas performa operasional dan profitabilitas kantor cabang Batam, perizinan kargo kawasan FTZ (Free Trade Zone), dan manajemen tim cabang.',
                'kualifikasi' => "• Pengalaman min. 4 tahun di level manajerial logistik / shipping agency\n• Memahami seluk beluk regulasi kawasan bebas FTZ Batam dan PPFTZ\n• Kemampuan kepemimpinan, negosiasi, dan penyelesaian masalah yang teruji\n• Memiliki network dengan shipping line di Batam & Singapura",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Finance & Freight Billing Staff',
                'kota' => 'Medan',
                'provinsi' => 'Sumatera Utara',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Jl. Putri Hijau No. 12, Kesawan, Medan Barat, Kota Medan 20111',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Finance & Accounting',
                'deskripsi' => 'Melakukan verifikasi tagihan vendor pelayaran/truk, penerbitan invoice penagihan ongkos angkut kepada klien, rekonsiliasi PPN/PPh pasal 23 kargo.',
                'kualifikasi' => "• Pendidikan min. D3/S1 Akuntansi / Keuangan / Perpajakan\n• Pengalaman kerja min. 1 tahun di bagian finance logistik / forwarder\n• Menguasai Ms. Excel (VLOOKUP, Pivot) dan e-Faktur Pajak\n• Jujur, teliti terhadap nominal angka, dan berintegritas tinggi",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Port Dispatcher & Stevedoring Coordinator',
                'kota' => 'Makassar',
                'provinsi' => 'Sulawesi Selatan',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Terminal Petikemas Makassar (TPM), Jl. Nusantara No. 320, Ujung Pandang, Kota Makassar 90164',
                'tipe_pekerjaan' => 'Full-Time',
                'departemen' => 'Operations',
                'deskripsi' => 'Mengawasi proses bongkar muat kontainer kapal kargo di dermaga pelabuhan, koordinasi dengan operator crane dan tally sheet lapangan.',
                'kualifikasi' => "• Pendidikan min. D3/S1 Ketatalaksanaan Pelayaran Niaga / Kepelabuhanan\n• Pengalaman min. 1 tahun di area dermaga pelabuhan / terminal petikemas\n• Siap bekerja di lapangan pelabuhan dengan shift bergilir\n• Memiliki ketahanan fisik prima dan fokus keselamatan kerja (K3)",
                'status' => 'Aktif',
            ],
            [
                'nama_karir' => 'Internship HR & Recruitment Assistant',
                'kota' => 'Surabaya',
                'provinsi' => 'Jawa Timur',
                'negara' => 'Indonesia',
                'alamat_detail' => 'Fastlog HQ, Jl. Pemuda No. 108, Genteng, Kota Surabaya 60271',
                'tipe_pekerjaan' => 'Internship',
                'departemen' => 'HR & General Affair',
                'deskripsi' => 'Membantu proses screening CV kandidat pelamar kerja, penjadwalan sesi wawancara, administrasi data onboarding karyawan baru dan absensi.',
                'kualifikasi' => "• Mahasiswa tingkat akhir / Fresh Graduate jurusan Psikologi / Manajemen SDM\n• Bersedia magang offline selama periode minimal 3 bulan\n• Komunikatif, ramah, dan teliti dalam pengelolaan dokumen\n• Mendapatkan uang saku bulanan dan sertifikat magang resmi",
                'status' => 'Tutup',
            ],
        ];

        foreach ($dummyKarirs as $item) {
            $baseSlug = Str::slug($item['nama_karir'] . '-' . $item['kota']);
            $slug = $baseSlug;
            $counter = 1;
            while (Karir::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-" . $counter++;
            }

            Karir::updateOrCreate(
                ['slug' => $slug],
                [
                    'nama_karir' => $item['nama_karir'],
                    'slug' => $slug,
                    'kota' => $item['kota'],
                    'provinsi' => $item['provinsi'],
                    'negara' => $item['negara'],
                    'alamat_detail' => $item['alamat_detail'],
                    'tipe_pekerjaan' => $item['tipe_pekerjaan'],
                    'departemen' => $item['departemen'],
                    'deskripsi' => $item['deskripsi'],
                    'kualifikasi' => $item['kualifikasi'],
                    'status' => $item['status'],
                ]
            );
        }
    }
}
