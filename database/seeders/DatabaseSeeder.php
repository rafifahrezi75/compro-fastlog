<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(BeritaSeeder::class);
        $this->call(KarirSeeder::class);
        $this->call(WilayahSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(MarketingSeeder::class);
        $this->call(TestimoniSeeder::class);
        $this->call(PelamarSeeder::class);
    }
}
