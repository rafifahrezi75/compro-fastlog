<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Info::create([
            'nama' => 'PT Fastlog Era Mandiri',
            'logo' => 'images/front-end/logo2.png',
            'kota' => 'Surabaya',
            'alamatLengkap' => 'Victoria Mainstreet Grand Pakuwon RA 08, Banjar Sugihan, Kec. Tandes, Kota SBY, Jawa Timur 60184',
            'email' => 'admin@fastlogem.co.id',
            'notelp' => '031 9934 3392',
            'linkFacebook' => 'https://www.facebook.com/share/17S7H2PTrG/',
            'linkInstagram' => 'https://www.instagram.com/fastlogem_?igsh=MWZ0Njg2emU1Z3g2Ng==',
            'linkX' => '#',
            'linkLinkedin' => '#',
        ]);
    }
}
