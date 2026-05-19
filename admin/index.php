<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/_layout.php';

$totalProducts = db()->query('SELECT COUNT(*) AS total FROM products')->fetch()['total'] ?? 0;
$totalFeeds = db()->query('SELECT COUNT(*) AS total FROM feeds')->fetch()['total'] ?? 0;
$totalReviews = db()->query('SELECT COUNT(*) AS total FROM reviews')->fetch()['total'] ?? 0;

admin_header('Dashboard');
?>
<div class="grid gap-5 md:grid-cols-3">
    <div class="rounded-lg bg-white p-6 shadow"><p class="text-sm text-gray-500">Total Produk</p><p class="mt-2 text-4xl font-bold"><?= e((string) $totalProducts) ?></p></div>
    <div class="rounded-lg bg-white p-6 shadow"><p class="text-sm text-gray-500">Konten Viral</p><p class="mt-2 text-4xl font-bold"><?= e((string) $totalFeeds) ?></p></div>
    <div class="rounded-lg bg-white p-6 shadow"><p class="text-sm text-gray-500">Testimoni</p><p class="mt-2 text-4xl font-bold"><?= e((string) $totalReviews) ?></p></div>
</div>
<div class="mt-8 rounded-lg bg-white p-6 shadow">
    <h3 class="mb-3 text-xl font-bold">Alur Pakai</h3>
    <p class="text-gray-600">Update produk, konten viral, testimoni, dan teks homepage lewat menu di sidebar. Semua perubahan langsung tampil di landing page.</p>
</div>
<?php admin_footer(); ?>
