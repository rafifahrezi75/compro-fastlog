<?php

namespace App\Console\Commands;

use App\Models\Berita;
use App\Models\Karir;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     * Jalankan dengan: php artisan sitemap:generate
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     */
    protected $description = 'Generate sitemap.xml dan simpan ke folder public/';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🗺  Generating sitemap...');

        $sitemap = Sitemap::create();

        // ============================================================
        // 1. Halaman Statis
        // ============================================================
        $staticPages = [
            [
                'url'        => route('home'),
                'priority'   => 1.0,
                'changefreq' => Url::CHANGE_FREQUENCY_WEEKLY,
                'lastmod'    => Carbon::now(),
            ],
            [
                'url'        => route('about'),
                'priority'   => 0.8,
                'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY,
                'lastmod'    => Carbon::now(),
            ],
            [
                'url'        => route('services'),
                'priority'   => 0.9,
                'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY,
                'lastmod'    => Carbon::now(),
            ],
            [
                'url'        => route('destination'),
                'priority'   => 0.7,
                'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY,
                'lastmod'    => Carbon::now(),
            ],
            [
                'url'        => route('berita'),
                'priority'   => 0.8,
                'changefreq' => Url::CHANGE_FREQUENCY_DAILY,
                'lastmod'    => Carbon::now(),
            ],
            [
                'url'        => route('career'),
                'priority'   => 0.8,
                'changefreq' => Url::CHANGE_FREQUENCY_WEEKLY,
                'lastmod'    => Carbon::now(),
            ],
            [
                'url'        => route('gallery'),
                'priority'   => 0.6,
                'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY,
                'lastmod'    => Carbon::now(),
            ],
            [
                'url'        => route('contact'),
                'priority'   => 0.7,
                'changefreq' => Url::CHANGE_FREQUENCY_YEARLY,
                'lastmod'    => Carbon::now(),
            ],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create($page['url'])
                    ->setPriority($page['priority'])
                    ->setChangeFrequency($page['changefreq'])
                    ->setLastModificationDate($page['lastmod'])
            );
        }

        $this->info('   ✓ ' . count($staticPages) . ' halaman statis ditambahkan.');

        // ============================================================
        // 2. Halaman Detail Layanan (Data Statis / Array)
        // ============================================================
        $servicesSlugs = [
            'custom-clearance',
            'reefer-logistic',
            'freight-forwarding',
            'inland-transport',
        ];

        foreach ($servicesSlugs as $slug) {
            $sitemap->add(
                Url::create(route('services.detail', $slug))
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setLastModificationDate(Carbon::now())
            );
        }

        $this->info('   ✓ ' . count($servicesSlugs) . ' halaman detail layanan ditambahkan.');

        // ============================================================
        // 3. Halaman Detail Berita (Dinamis dari DB)
        // ============================================================
        $beritas = Berita::where('status', 'published')
            ->select(['slug', 'updated_at'])
            ->latest()
            ->get();

        foreach ($beritas as $berita) {
            $sitemap->add(
                Url::create(route('berita.detail', $berita->slug))
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setLastModificationDate($berita->updated_at ?? Carbon::now())
            );
        }

        $this->info('   ✓ ' . $beritas->count() . ' halaman detail berita ditambahkan.');

        // ============================================================
        // 4. Halaman Detail Karir (Dinamis dari DB)
        // ============================================================
        $karirs = Karir::where('status', 'Aktif')
            ->select(['slug', 'updated_at'])
            ->latest()
            ->get();

        foreach ($karirs as $karir) {
            $sitemap->add(
                Url::create(route('career.detail', $karir->slug))
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setLastModificationDate($karir->updated_at ?? Carbon::now())
            );
        }

        $this->info('   ✓ ' . $karirs->count() . ' halaman detail karir ditambahkan.');

        // ============================================================
        // 5. Simpan ke public/sitemap.xml
        // ============================================================
        $outputPath = public_path('sitemap.xml');
        $sitemap->writeToFile($outputPath);

        $this->newLine();
        $this->info('✅ Sitemap berhasil di-generate!');
        $this->line("   📄 Lokasi file : {$outputPath}");
        $this->line('   🌐 Akses URL  : ' . url('sitemap.xml'));
        $this->newLine();
        $this->comment('💡 Tips: Tambahkan command ini ke task scheduler (cron job) agar sitemap otomatis diperbarui.');
        $this->comment('   Contoh di routes/console.php: Schedule::command(\'sitemap:generate\')->daily();');

        return self::SUCCESS;
    }
}
