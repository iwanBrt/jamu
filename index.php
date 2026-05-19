<?php
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/data.php';

$products = active_products();
$feeds = active_feeds();
$reviews = approved_reviews();
$settings = homepage_settings();

$brand = $settings['brand_name'] ?? 'BOS MOCHI';
$whatsapp = $settings['whatsapp'] ?? '6281265541219';
$instagram = $settings['instagram'] ?? 'medansnackvins';
$tiktok = $settings['tiktok'] ?? 'medansnackvins';
$address = $settings['address'] ?? 'Jl. Tuasan No. 180, Pancing, Medan';
$heroTitle = $settings['hero_title'] ?? 'Jajanan Viral Favorit Anak Muda';
$heroSubtitle = $settings['hero_subtitle'] ?? 'Mochi kenyal dengan isian melimpah dan berbagai jajanan viral kekinian untuk menemani hari serumu.';
$operationalHours = $settings['operational_hours'] ?? '13.00 - 21.00';
$orderMethods = $settings['order_methods'] ?? 'WhatsApp, DM Instagram, datang langsung, dan GrabFood';
$fillingTip = $settings['filling_tip'] ?? 'Bingung pilih cream atau coklat? Cream lebih lembut dan ringan, coklat lebih legit dan manis.';
$bestSeller = $products[0] ?? null;
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($brand) ?> MEDAN - Mochi & Jajanan Viral</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&family=Fraunces:opsz,wght@9..144,650;9..144,750&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="./dist/output.css" rel="stylesheet">
    <style>
        @media (min-width: 768px) {
            #mobile-menu-btn, #mobile-menu {
                display: none !important;
            }
            /* Memaksa elemen desktop muncul karena kelas Tailwind statis tidak terbaca */
            #desktop-nav { display: flex !important; }
            #btn-admin { display: grid !important; }
            #btn-order { display: inline-flex !important; }
        }
    </style>
</head>
<body class="font-sans text-brand-cream antialiased">
    <div class="page-veil fixed inset-0 pointer-events-none"></div>

    <header class="fixed left-0 right-0 top-0 z-[60] border-b border-brand-pink/15 bg-brand-dark shadow-xl shadow-black/20">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-5 lg:px-12">
            <a href="#" class="flex items-center gap-3 text-brand-cream" aria-label="<?= e($brand) ?>">
                <div class="h-10 w-10 shrink-0 overflow-hidden rounded-full ring-2 ring-brand-pink/25 sm:h-12 sm:w-12">
                    <img src="./logo.jpeg" alt="Logo <?= e($brand) ?>" class="h-full w-full object-cover">
                </div>
                <span class="font-display text-2xl font-extrabold leading-none tracking-tight text-brand-pink-light sm:text-3xl uppercase"><?= e($brand) ?></span>
            </a>
            <nav id="desktop-nav" class="hidden rounded-lg bg-brand-brown px-8 py-3 text-sm font-bold text-brand-cream md:flex md:items-center md:gap-9">
                <a href="#" class="text-brand-cream hover:text-brand-yellow transition">Beranda</a>
                <a href="#produk" class="transition hover:text-brand-yellow">Produk</a>
                <a href="#tentang" class="transition hover:text-brand-yellow">Tentang</a>
                <a href="#kontak" class="transition hover:text-brand-yellow">Kontak</a>
            </nav>
            <div class="flex items-center gap-2">
                <a id="btn-admin" href="admin/login.php" class="hidden h-10 w-10 place-items-center rounded-lg bg-brand-brown text-brand-cream transition hover:text-brand-yellow sm:grid sm:h-11 sm:w-11" aria-label="Admin">
                    <i class="ph ph-user text-xl"></i>
                </a>
                <a id="btn-order" href="https://wa.me/<?= e($whatsapp) ?>" class="hidden rounded-lg bg-brand-pink px-6 py-3 text-sm font-extrabold text-white shadow-lg shadow-brand-pink/20 transition hover:bg-brand-red sm:inline-flex">Order Sekarang</a>
                <button id="mobile-menu-btn" class="grid h-10 w-10 place-items-center rounded-lg bg-brand-brown text-brand-cream transition hover:text-brand-yellow md:hidden" aria-label="Menu">
                    <i class="ph ph-list text-2xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" style="max-height: 0px; opacity: 0; transition: all 0.3s ease-in-out;" class="overflow-hidden bg-brand-dark/95 backdrop-blur-md md:hidden">
            <nav class="flex flex-col px-5 py-4 text-center text-sm font-bold text-brand-cream">
                <a href="#" class="py-3 transition hover:text-brand-yellow">Beranda</a>
                <a href="#produk" class="py-3 transition hover:text-brand-yellow">Produk</a>
                <a href="#tentang" class="py-3 transition hover:text-brand-yellow">Tentang</a>
                <a href="#kontak" class="py-3 transition hover:text-brand-yellow">Kontak</a>
                <a href="admin/login.php" class="py-3 transition hover:text-brand-yellow">Admin</a>
                <a href="https://wa.me/<?= e($whatsapp) ?>" class="mx-auto mt-4 inline-flex rounded-lg bg-brand-pink px-6 py-3 text-sm font-extrabold text-white shadow-lg shadow-brand-pink/20 transition hover:bg-brand-red">Order Sekarang</a>
            </nav>
        </div>
    </header>

    <main class="relative">
        <section class="relative overflow-hidden px-5 pb-12 pt-32 sm:pt-36 lg:min-h-screen lg:px-12 lg:pb-24 lg:pt-40">
            <span class="floating-mochi left-[3%] top-[34%] hidden opacity-80 lg:block" style="--rotate:-28deg"></span>
            <span class="floating-mochi bottom-[16%] left-[10%] hidden scale-125 opacity-75 lg:block" style="--rotate:42deg"></span>
            <span class="floating-mochi right-[7%] top-[11%] hidden scale-75 opacity-70 lg:block" style="--rotate:18deg"></span>
            <div class="mx-auto grid max-w-7xl items-center gap-10 lg:grid-cols-[0.92fr_1.08fr]">
                <div class="relative z-20" data-aos="fade-up">
                    <p class="mb-5 inline-flex rounded-full bg-brand-cream/10 px-4 py-2 text-xs font-extrabold uppercase tracking-[0.18em] text-brand-pink-light ring-1 ring-brand-cream/15 sm:px-5 sm:text-sm">Mochi & Jajanan Viral</p>
                    <h1 class="text-shadow-soft max-w-3xl font-display text-4xl font-extrabold leading-[1.02] text-brand-pink-light sm:text-6xl lg:text-8xl"><?= e($heroTitle) ?></h1>
                    <p class="mt-5 max-w-xl text-base font-semibold leading-7 text-brand-cream/72 sm:mt-7 sm:text-lg sm:leading-8"><?= e($heroSubtitle) ?></p>
                    <div class="mt-8 flex flex-wrap gap-4 sm:mt-10">
                        <a href="#produk" class="pulse-glow inline-flex items-center justify-center rounded-full bg-brand-pink px-8 py-4 font-extrabold text-white shadow-xl shadow-brand-pink/20 transition hover:-translate-y-1 hover:bg-brand-red sm:px-12 sm:py-5 sm:text-lg">Pesan Sekarang</a>
                        <a href="#tentang" class="inline-flex items-center justify-center rounded-full border-2 border-brand-pink/30 bg-transparent px-8 py-4 font-extrabold text-brand-pink-light backdrop-blur-md transition hover:bg-brand-pink/10 sm:px-10">Lihat Cerita Kami</a>
                    </div>
                    <div class="mt-8 grid gap-3 sm:grid-cols-3">
                        <div class="glass-soft rounded-2xl p-4"><p class="text-xs font-black uppercase tracking-[0.18em] text-brand-pink-light/70">Best Seller</p><p class="mt-1 font-display text-xl font-extrabold text-brand-cream"><?= e($bestSeller['name'] ?? 'Strawberry Coklat') ?></p></div>
                        <div class="glass-soft rounded-2xl p-4"><p class="text-xs font-black uppercase tracking-[0.18em] text-brand-pink-light/70">Jam Buka</p><p class="mt-1 font-display text-xl font-extrabold text-brand-cream"><?= e($operationalHours) ?></p></div>
                        <div class="glass-soft rounded-2xl p-4"><p class="text-xs font-black uppercase tracking-[0.18em] text-brand-pink-light/70">Order</p><p class="mt-1 text-sm font-extrabold leading-5 text-brand-cream"><?= e($orderMethods) ?></p></div>
                    </div>
                </div>
                <div class="relative min-h-[23rem] sm:min-h-[32rem] lg:min-h-[42rem]" data-aos="fade-left">
                    <div class="hero-glow absolute inset-0"></div>
                    <div class="absolute inset-x-0 top-0 z-10 mx-auto flex h-[23rem] w-full max-w-[26rem] items-center justify-center sm:right-0 sm:mx-0 sm:h-[31rem] sm:max-w-[34rem] lg:h-[41rem] lg:max-w-[42rem]">
                        <div class="h-64 w-64 overflow-hidden rounded-full border-8 border-brand-pink/10 shadow-[0_32px_64px_rgba(219,107,139,0.3)] sm:h-80 sm:w-80 lg:h-[28rem] lg:w-[28rem]">
                            <img src="<?= e($bestSeller['image']) ?>" alt="Produk Utama <?= e($brand) ?>" class="h-full w-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative z-30 px-5 pt-8 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <div class="glass flex flex-wrap items-center justify-between gap-6 rounded-[2rem] p-6 sm:p-10">
                    <div class="max-w-md" data-aos="fade-right">
                        <span class="mb-3 inline-block rounded-full bg-brand-red px-4 py-1 text-[10px] font-black uppercase tracking-widest text-white">Lagi Viral</span>
                        <h2 class="font-display text-3xl font-extrabold text-brand-pink-light">Lagi Viral Minggu Ini!</h2>
                        <p class="mt-3 font-semibold text-brand-cream/60">Best seller ditempatkan paling depan: Strawberry Coklat. Cocok buat yang suka rasa buah segar dengan coklat legit.</p>
                    </div>
                    <div class="flex flex-1 flex-wrap gap-4" data-aos="fade-left">
                        <?php foreach (array_slice($products, 0, 2) as $index => $product): ?>
                            <div class="glass-soft flex flex-1 min-w-[200px] items-center gap-4 rounded-2xl p-4">
                                <div class="h-16 w-16 overflow-hidden rounded-xl border-2 border-brand-pink/20">
                                    <img src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>" class="h-full w-full object-cover">
                                </div>
                                <div>
                                    <p class="text-xs font-black text-brand-pink"><?= $index === 0 ? 'BEST SELLER' : 'TOP #' . ($index + 1) ?></p>
                                    <p class="font-display font-bold text-brand-pink-light"><?= e($product['name']) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <section id="produk" class="relative z-20 px-5 pb-20 pt-20 sm:pb-24 lg:px-12">
            <div class="mx-auto max-w-6xl">
                <div class="mb-6 flex items-end justify-between gap-4">
                    <div>
                        <p class="text-sm font-extrabold uppercase tracking-[0.2em] text-brand-pink-light/80">Katalog Jajanan</p>
                        <h2 class="mt-2 font-display text-2xl font-extrabold leading-tight text-brand-pink-light sm:text-3xl">Best seller paling depan, geser untuk lihat semua menu</h2>
                    </div>
                    <div class="hidden gap-2 sm:flex">
                        <button class="glass-soft grid h-11 w-11 place-items-center rounded-full text-brand-cream transition hover:text-brand-pink-light" onclick="document.getElementById('produk-track').scrollBy({ left: -320, behavior: 'smooth' })"><i class="ph ph-arrow-left text-xl"></i></button>
                        <button class="glass-soft grid h-11 w-11 place-items-center rounded-full text-brand-cream transition hover:text-brand-pink-light" onclick="document.getElementById('produk-track').scrollBy({ left: 320, behavior: 'smooth' })"><i class="ph ph-arrow-right text-xl"></i></button>
                    </div>
                </div>
                <div id="produk-track" class="product-scroll flex gap-5 overflow-x-auto px-1 pb-8 pt-16">
                    <?php foreach ($products as $product): ?>
                        <article class="glass min-w-[15.75rem] rounded-[1.65rem] p-4 text-center sm:min-w-[19rem] sm:p-5" data-aos="fade-up">
                            <div class="relative mx-auto -mt-16 h-32 w-32 overflow-hidden rounded-full border-4 border-brand-pink/10 shadow-xl sm:h-36 sm:w-36">
                                <img src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>" class="h-full w-full object-cover">
                                <?php if ((int) $product['is_best_seller'] === 1): ?>
                                    <span class="absolute right-0 top-2 rounded-full bg-brand-red px-3 py-1 text-[8px] font-black uppercase text-white shadow-lg">Best Seller</span>
                                <?php endif; ?>
                            </div>
                            <div class="mt-3 flex items-center justify-center gap-2"><span class="rounded-full bg-brand-cream/10 px-3 py-1 text-[10px] font-black uppercase tracking-wider text-brand-yellow"><?= e($product['category_name'] ?? 'Menu') ?></span><?php if ((int) $product['is_premium'] === 1): ?><span class="rounded-full bg-brand-pink/20 px-3 py-1 text-[10px] font-black uppercase tracking-wider text-brand-pink-light">Premium</span><?php endif; ?></div><h2 class="mt-3 font-display text-2xl font-extrabold text-brand-pink-light"><?= e($product['name']) ?></h2>
                            <p class="mx-auto mt-2 max-w-[12rem] text-xs font-bold leading-5 text-brand-cream/55"><?= e($product['description']) ?></p>
                            <div class="mt-5 flex items-center justify-between">
                                <span class="font-display text-2xl font-extrabold text-brand-cream"><?= rupiah($product['price']) ?></span>
                                <a href="https://wa.me/<?= e($whatsapp) ?>?text=Halo%20saya%20mau%20pesan%20<?= urlencode($product['name']) ?>" class="grid h-11 w-11 place-items-center rounded-full bg-brand-pink text-white transition hover:bg-brand-red"><i class="ph ph-plus text-xl font-bold"></i></a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>


        <section class="relative px-5 pb-20 lg:px-12">
            <div class="mx-auto grid max-w-7xl gap-5 md:grid-cols-3">
                <div class="glass rounded-[1.5rem] p-6 md:col-span-2">
                    <p class="text-sm font-extrabold uppercase tracking-[0.2em] text-brand-pink-light/70">Bingung pilih isian?</p>
                    <h2 class="mt-2 font-display text-3xl font-extrabold text-brand-pink-light">Cream atau coklat, pilih sesuai mood kamu.</h2>
                    <p class="mt-4 text-sm font-semibold leading-7 text-brand-cream/60"><?= e($fillingTip) ?></p>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl bg-brand-cream/10 p-5"><h3 class="font-display text-2xl font-bold text-brand-cream">Cream</h3><p class="mt-2 text-sm font-semibold leading-6 text-brand-cream/55">Rasa lebih ringan, lembut, cocok buat varian mangga, durian, strawberry, dan lotus.</p></div>
                        <div class="rounded-2xl bg-brand-pink/15 p-5"><h3 class="font-display text-2xl font-bold text-brand-cream">Coklat</h3><p class="mt-2 text-sm font-semibold leading-6 text-brand-cream/55">Rasa lebih legit dan manis, cocok buat Strawberry Coklat, Anggur Coklat, Oreo, dan Crunchy.</p></div>
                    </div>
                </div>
                <div class="glass rounded-[1.5rem] p-6">
                    <p class="text-sm font-extrabold uppercase tracking-[0.2em] text-brand-pink-light/70">Info Order</p>
                    <h3 class="mt-2 font-display text-3xl font-extrabold text-brand-pink-light">Buka <?= e($operationalHours) ?></h3>
                    <p class="mt-4 text-sm font-semibold leading-7 text-brand-cream/60">Order bisa lewat <?= e($orderMethods) ?>. Tiramisu cake ready mulai jam 2 siang.</p>
                    <a href="https://wa.me/<?= e($whatsapp) ?>" class="mt-6 inline-flex rounded-full bg-brand-pink px-6 py-3 font-extrabold text-white transition hover:bg-brand-red">Chat Sekarang</a>
                </div>
            </div>
        </section>        <section class="relative px-5 pb-20 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <div class="mb-12 text-center">
                    <p class="text-sm font-extrabold uppercase tracking-[0.2em] text-brand-pink-light/60">Social Media Vibes</p>
                    <h2 class="mt-2 font-display text-4xl font-extrabold text-brand-pink-light">Seen on TikTok</h2>
                </div>
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:gap-6">
                    <?php foreach ($feeds as $feed): ?>
                        <a href="<?= e($feed['source_url']) ?>" target="_blank" class="group relative aspect-[9/16] overflow-hidden rounded-[2rem] bg-brand-cream/5 ring-1 ring-white/10 transition-all duration-500 hover:ring-brand-pink/50">
                            <img src="<?= e($feed['image']) ?>" alt="<?= e($feed['title']) ?>" class="h-full w-full object-cover opacity-60 transition duration-700 group-hover:scale-110 group-hover:opacity-100">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-60 transition-opacity group-hover:opacity-40"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-md transition-all duration-300 group-hover:scale-110 group-hover:bg-brand-pink">
                                    <i class="ph-fill ph-play text-2xl"></i>
                                </div>
                            </div>
                            <div class="absolute bottom-5 left-5 right-5 flex items-center justify-between">
                                <div class="flex items-center gap-1.5"><i class="ph-fill ph-heart text-brand-pink"></i><span class="text-[10px] font-bold text-white/90"><?= compact_number($feed['likes']) ?></span></div>
                                <span class="text-[9px] font-black uppercase tracking-wider text-white/50">Watch</span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="tentang" class="relative px-5 pb-20 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <article class="glass relative grid gap-8 rounded-[1.5rem] p-5 sm:rounded-[2rem] sm:p-7 md:p-12 lg:grid-cols-[1fr_22rem_1fr]">
                    <div class="space-y-8 sm:space-y-12">
                        <div class="relative pl-16"><span class="absolute left-0 top-0 font-display text-7xl font-extrabold leading-none text-brand-cream/10 sm:text-8xl">1</span><h3 class="font-display text-2xl font-bold text-brand-cream sm:text-3xl">Bahan Premium</h3><p class="mt-3 max-w-sm text-sm font-semibold leading-7 text-brand-cream/50">Menggunakan tepung ketan berkualitas tinggi untuk tekstur yang super kenyal.</p></div>
                        <div class="relative pl-16"><span class="absolute left-0 top-0 font-display text-7xl font-extrabold leading-none text-brand-cream/10 sm:text-8xl">2</span><h3 class="font-display text-2xl font-bold text-brand-cream sm:text-3xl">Selalu Fresh</h3><p class="mt-3 max-w-sm text-sm font-semibold leading-7 text-brand-cream/50">Dibuat setiap hari handmade untuk menjaga kualitas rasa dan kesegaran mochi.</p></div>
                    </div>
                    <div class="relative mx-auto flex h-80 w-80 flex-col items-center justify-center gap-6">
                        <div class="h-full w-full overflow-hidden rounded-full border-8 border-brand-pink/10 shadow-2xl"><img src="./logo.jpeg" alt="<?= e($brand) ?> Premium" class="h-full w-full object-cover"></div>
                        <a href="#kontak" class="absolute bottom-2 rounded-full bg-brand-pink px-10 py-3.5 font-display text-lg font-extrabold text-white shadow-xl shadow-brand-pink/20 transition hover:bg-brand-red">Pesan</a>
                    </div>
                    <div class="space-y-8 sm:space-y-12">
                        <div class="relative pl-16 lg:pl-20"><span class="absolute left-0 top-0 font-display text-7xl font-extrabold leading-none text-brand-cream/10 sm:text-8xl">3</span><h3 class="font-display text-2xl font-bold text-brand-cream sm:text-3xl">Varian Viral</h3><p class="mt-3 max-w-sm text-sm font-semibold leading-7 text-brand-cream/50">Menyediakan berbagai rasa yang sedang hits dan viral di media sosial.</p></div>
                        <div class="relative pl-16 lg:pl-20"><span class="absolute left-0 top-0 font-display text-7xl font-extrabold leading-none text-brand-cream/10 sm:text-8xl">4</span><h3 class="font-display text-2xl font-bold text-brand-cream sm:text-3xl">Kemasan Cantik</h3><p class="mt-3 max-w-sm text-sm font-semibold leading-7 text-brand-cream/50">Packaging estetik yang cocok dijadikan hampers atau hadiah.</p></div>
                    </div>
                </article>
            </div>
        </section>

        <section class="px-5 pb-20 lg:px-12">
            <div class="mx-auto max-w-7xl">
                <div class="mb-12 flex flex-wrap items-end justify-between gap-6">
                    <div><p class="text-sm font-extrabold uppercase tracking-[0.2em] text-brand-pink-light/60">Apa kata mereka?</p><h2 class="mt-2 font-display text-4xl font-extrabold text-brand-pink-light">Testimoni Pecinta Mochi</h2></div>
                    <div class="glass-soft flex items-center gap-2 rounded-full px-6 py-3"><span class="font-black text-brand-pink">4.9/5</span><div class="flex text-brand-pink text-sm"><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i><i class="ph-fill ph-star"></i></div><span class="text-xs font-bold text-brand-cream/40">dari 500+ pembeli</span></div>
                </div>
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <?php foreach ($reviews as $review): ?>
                        <div class="glass p-8 rounded-3xl" data-aos="fade-up">
                            <div class="flex gap-1 text-brand-pink mb-4"><?php for ($i = 0; $i < (int) $review['rating']; $i++): ?><i class="ph-fill ph-star"></i><?php endfor; ?></div>
                            <p class="font-semibold italic text-brand-cream/80 mb-6">"<?= e($review['comment']) ?>"</p>
                            <div class="flex items-center gap-3"><div class="h-10 w-10 rounded-full bg-brand-pink/20"></div><div><p class="text-sm font-bold text-brand-pink-light"><?= e($review['customer_name']) ?></p><p class="text-xs font-bold text-brand-cream/30"><?= e($review['customer_role'] ?: $review['product_name']) ?></p></div></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section id="kontak" class="px-5 pb-16 lg:px-12">
            <div class="glass mx-auto grid max-w-7xl gap-8 overflow-hidden rounded-[1.5rem] p-5 sm:rounded-[2rem] sm:p-8 md:grid-cols-[1fr_18rem] md:p-12">
                <div><h2 class="font-display text-3xl font-extrabold leading-tight text-brand-pink-light sm:text-4xl lg:text-5xl">Cari tahu varian mochi mana yang paling cocok buat kamu.</h2><a href="https://wa.me/<?= e($whatsapp) ?>" class="mt-8 inline-flex w-full items-center justify-center rounded-full bg-brand-pink px-7 py-4 font-extrabold text-white transition hover:bg-brand-red sm:w-auto sm:px-9">Konsultasi via WhatsApp</a></div>
                <div class="relative grid min-h-48 place-items-center sm:min-h-52"><div class="relative h-40 w-40 overflow-hidden rounded-full border-4 border-brand-pink/20 shadow-2xl sm:h-48 sm:w-48 lg:h-56 lg:w-56"><img src="./logo.jpeg" alt="<?= e($brand) ?> Logo" class="h-full w-full object-cover"></div><div class="hero-glow absolute inset-0 -z-10 opacity-30"></div></div>
            </div>
        </section>
    </main>

    <footer class="px-5 pb-8 lg:px-12">
        <div class="mx-auto max-w-7xl border-t border-brand-cream/10 pt-8">
            <div class="grid gap-8 pb-8 md:grid-cols-[1.2fr_0.8fr_0.8fr_1fr]">
                <div><a href="#" class="inline-flex items-center gap-3 text-brand-cream"><div class="h-10 w-10 shrink-0 overflow-hidden rounded-full ring-2 ring-brand-pink/20"><img src="./logo.jpeg" alt="Logo <?= e($brand) ?>" class="h-full w-full object-cover"></div><span class="font-display text-2xl font-extrabold leading-none tracking-tight text-brand-pink-light uppercase"><?= e($brand) ?></span></a><p class="mt-4 max-w-sm text-sm font-semibold leading-7 text-brand-cream/50">Pusat mochi dan jajanan viral di Medan. Menghadirkan rasa autentik dengan sentuhan modern untuk setiap momen manismu.</p></div>
                <div><h3 class="font-display text-xl font-extrabold text-brand-yellow">Kontak</h3><div class="mt-4 space-y-3 text-sm font-bold text-brand-cream/55"><a href="https://wa.me/<?= e($whatsapp) ?>" class="flex items-center gap-3 transition hover:text-brand-yellow"><i class="ph ph-whatsapp-logo text-lg text-brand-yellow"></i><span>+62 812-6554-1219</span></a><a href="https://instagram.com/<?= e($instagram) ?>" class="flex items-center gap-3 transition hover:text-brand-yellow"><i class="ph ph-instagram-logo text-lg text-brand-yellow"></i><span>@<?= e($instagram) ?></span></a><a href="https://www.tiktok.com/@<?= e($tiktok) ?>?is_from_webapp=1&amp;sender_device=pc" target="_blank" class="flex items-center gap-3 transition hover:text-brand-yellow"><i class="ph ph-tiktok-logo text-lg text-brand-yellow"></i><span>@<?= e($tiktok) ?></span></a><p class="flex items-center gap-3"><i class="ph ph-map-pin text-lg text-brand-yellow"></i><span><?= e($address) ?></span></p></div></div>
                <div><h3 class="font-display text-xl font-extrabold text-brand-yellow">Menu</h3><nav class="mt-4 grid gap-3 text-sm font-bold text-brand-cream/55"><a href="#" class="transition hover:text-brand-yellow">Beranda</a><a href="#produk" class="transition hover:text-brand-yellow">Produk</a><a href="#tentang" class="transition hover:text-brand-yellow">Tentang</a><a href="#kontak" class="transition hover:text-brand-yellow">Kontak</a></nav></div>
                <div><h3 class="font-display text-xl font-extrabold text-brand-yellow">Layanan</h3><div class="mt-4 space-y-3 text-sm font-bold text-brand-cream/55"><p class="flex items-center gap-3"><i class="ph ph-moped text-lg text-brand-yellow"></i><span>BOS MOCHI TUASAN (GoFood) - <?= e($operationalHours) ?></span></p><p class="flex items-center gap-3"><i class="ph ph-money text-lg text-brand-yellow"></i><span>Buka Peluang Reseller</span></p></div></div>
            </div>
            <div class="flex flex-col justify-between gap-3 border-t border-brand-cream/10 pt-6 text-sm font-bold text-brand-cream/38 md:flex-row"><p>&copy; 2026 <?= e($brand) ?> MEDAN. Semua hak dilindungi.</p><p>Instagram &middot; TikTok &middot; Marketplace &middot; WhatsApp</p></div>
        </div>
    </footer>

    <a href="https://wa.me/<?= e($whatsapp) ?>" class="pulse-glow fixed bottom-6 right-6 z-[60] flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-2xl transition hover:scale-110 sm:h-16 sm:w-16"><i class="ph-fill ph-whatsapp-logo text-3xl sm:text-4xl"></i></a>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, duration: 750, offset: 90 });
        
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuBtn && mobileMenu) {
            function toggleMenu() {
                const isClosed = mobileMenu.style.maxHeight === '0px' || mobileMenu.style.maxHeight === '';
                if (isClosed) {
                    mobileMenu.style.maxHeight = '500px';
                    mobileMenu.style.opacity = '1';
                    mobileMenu.classList.add('border-t', 'border-brand-pink/15');
                } else {
                    mobileMenu.style.maxHeight = '0px';
                    mobileMenu.style.opacity = '0';
                    mobileMenu.classList.remove('border-t', 'border-brand-pink/15');
                }
            }

            function closeMenu() {
                mobileMenu.style.maxHeight = '0px';
                mobileMenu.style.opacity = '0';
                mobileMenu.classList.remove('border-t', 'border-brand-pink/15');
            }

            mobileMenuBtn.addEventListener('click', toggleMenu);
            
            // Close menu when clicking a link
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', closeMenu);
            });
        }
        
        // Continuous Smooth Auto Scroll Produk Track
        const produkTrack = document.getElementById('produk-track');
        if (produkTrack) {
            // Clone items for an infinite scrolling illusion
            const items = Array.from(produkTrack.children);
            items.forEach(item => {
                const clone = item.cloneNode(true);
                // Remove aos attributes from clones to prevent animation glitches
                clone.removeAttribute('data-aos');
                produkTrack.appendChild(clone);
            });

            let autoScrollReq;
            let scrollSpeed = 0.8; // Smooth slow speed
            
            const smoothScroll = () => {
                // If we've scrolled past the first set of items, reset seamlessly
                if (produkTrack.scrollLeft >= produkTrack.scrollWidth / 2) {
                    produkTrack.scrollLeft -= produkTrack.scrollWidth / 2;
                }
                
                produkTrack.scrollLeft += scrollSpeed;
                autoScrollReq = requestAnimationFrame(smoothScroll);
            };

            const startAutoScroll = () => {
                cancelAnimationFrame(autoScrollReq);
                autoScrollReq = requestAnimationFrame(smoothScroll);
            };

            const stopAutoScroll = () => {
                cancelAnimationFrame(autoScrollReq);
            };

            // Wait a moment for AOS animations to finish before starting scroll
            setTimeout(startAutoScroll, 1000);

            // Pause when user is interacting with it
            produkTrack.addEventListener('mouseenter', stopAutoScroll);
            produkTrack.addEventListener('mouseleave', startAutoScroll);
            produkTrack.addEventListener('touchstart', stopAutoScroll, { passive: true });
            produkTrack.addEventListener('touchend', startAutoScroll, { passive: true });
        }
    </script>
</body>
</html>

