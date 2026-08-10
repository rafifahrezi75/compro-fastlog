<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Marketing::truncate();

        $marketings = [
            [
                'nama' => 'Budi Santoso',
                'divisi' => 'Marketing Executive',
                'no_wa' => '6281234567890',
                'foto' => 'marketings/profile1.png',
                'status' => 'online',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Aminah',
                'divisi' => 'Sales Representative',
                'no_wa' => '6289876543210',
                'foto' => 'marketings/profile2.png',
                'status' => 'offline',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Andi Wijaya',
                'divisi' => 'Customer Success',
                'no_wa' => '6285554443332',
                'foto' => 'marketings/profile3.png',
                'status' => 'online',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \App\Models\Marketing::insert($marketings);
    }
}
