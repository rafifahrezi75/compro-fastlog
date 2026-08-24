<?php

/**
 * SEO Image Helper — Fastlog Era Mandiri
 *
 * Cara pakai di Blade:
 *   {!! seo_image($berita->gambar_url, $berita->judul, 'w-full h-64 object-cover') !!}
 *
 * Cara pakai untuk gambar hero/above-the-fold (eager loading):
 *   {!! seo_image(asset('images/front-end/fastlog1.png'), 'Hero Fastlog', 'w-full', true) !!}
 */
if (! function_exists('seo_image')) {
    /**
     * Render tag <img> dengan atribut SEO-friendly & performa optimal.
     *
     * @param  string       $src      URL gambar
     * @param  string       $alt      Teks alt yang deskriptif (WAJIB untuk SEO & aksesibilitas)
     * @param  string       $class    Kelas CSS Tailwind / custom
     * @param  bool         $eager    true = gambar penting / above-the-fold (eager load), false = lazy load
     * @param  int|null     $width    Atribut width (opsional, bantu browser hitung layout shift / CLS)
     * @param  int|null     $height   Atribut height (opsional)
     * @return string                 HTML tag <img>
     */
    function seo_image(
        string $src,
        string $alt,
        string $class = '',
        bool   $eager = false,
        ?int   $width = null,
        ?int   $height = null
    ): string {
        // Pastikan alt tidak kosong — Google mengandalkan alt untuk konteks gambar
        $safeAlt = htmlspecialchars(trim($alt) ?: 'Fastlog Era Mandiri', ENT_QUOTES, 'UTF-8');
        $safeSrc = htmlspecialchars(trim($src), ENT_QUOTES, 'UTF-8');

        $loading  = $eager ? 'eager' : 'lazy';
        $decoding = $eager ? 'sync' : 'async';

        $attrs = [
            'src'      => $safeSrc,
            'alt'      => $safeAlt,
            'loading'  => $loading,
            'decoding' => $decoding,
        ];

        if ($class) {
            $attrs['class'] = htmlspecialchars($class, ENT_QUOTES, 'UTF-8');
        }

        if ($width !== null) {
            $attrs['width'] = $width;
        }

        if ($height !== null) {
            $attrs['height'] = $height;
        }

        // Bangun string atribut
        $attrString = '';
        foreach ($attrs as $key => $value) {
            $attrString .= " {$key}=\"{$value}\"";
        }

        return "<img{$attrString}>";
    }
}

if (! function_exists('seo_picture')) {
    /**
     * Render tag <picture> dengan sumber WebP + fallback JPEG/PNG.
     * Ideal untuk gambar produk, hero, atau thumbnail yang butuh performa maksimal.
     *
     * @param  string  $srcWebp   URL file .webp
     * @param  string  $srcFallback URL file .jpg/.png (fallback untuk browser lama)
     * @param  string  $alt       Teks alt
     * @param  string  $class     Kelas CSS
     * @param  bool    $eager     true untuk above-the-fold
     * @return string             HTML tag <picture>
     */
    function seo_picture(
        string $srcWebp,
        string $srcFallback,
        string $alt,
        string $class = '',
        bool   $eager = false
    ): string {
        $safeAlt      = htmlspecialchars(trim($alt) ?: 'Fastlog Era Mandiri', ENT_QUOTES, 'UTF-8');
        $safeWebp     = htmlspecialchars(trim($srcWebp), ENT_QUOTES, 'UTF-8');
        $safeFallback = htmlspecialchars(trim($srcFallback), ENT_QUOTES, 'UTF-8');
        $safeClass    = $class ? ' class="' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') . '"' : '';

        $loading  = $eager ? 'eager' : 'lazy';
        $decoding = $eager ? 'sync' : 'async';

        return <<<HTML
        <picture>
            <source srcset="{$safeWebp}" type="image/webp">
            <img src="{$safeFallback}" alt="{$safeAlt}" loading="{$loading}" decoding="{$decoding}"{$safeClass}>
        </picture>
        HTML;
    }
}
