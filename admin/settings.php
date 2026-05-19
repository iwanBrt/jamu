<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/_layout.php';

$keys = [
    'brand_name' => 'Nama Brand',
    'whatsapp' => 'Nomor WhatsApp, format 628xxx',
    'instagram' => 'Username Instagram',
    'tiktok' => 'Username TikTok',
    'address' => 'Alamat',
    'hero_title' => 'Judul Hero',
    'hero_subtitle' => 'Subjudul Hero',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = db()->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)');

    foreach ($keys as $key => $label) {
        $stmt->execute([$key, $_POST[$key] ?? '']);
    }

    redirect('settings.php?saved=1');
}

$rows = db()->query('SELECT setting_key, setting_value FROM settings')->fetchAll();
$settings = [];
foreach ($rows as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

admin_header('Setting Landing');
?>
<?php if (isset($_GET['saved'])): ?>
    <div class="mb-5 rounded bg-green-50 px-4 py-3 text-green-700">Setting berhasil disimpan.</div>
<?php endif; ?>

<form method="post" class="grid gap-4 rounded-lg bg-white p-6 shadow">
    <?php foreach ($keys as $key => $label): ?>
        <label class="grid gap-2">
            <span class="text-sm font-semibold"><?= e($label) ?></span>
            <?php if (in_array($key, ['hero_subtitle', 'address', 'order_methods', 'filling_tip'], true)): ?>
                <textarea class="rounded border px-4 py-2" name="<?= e($key) ?>"><?= e($settings[$key] ?? '') ?></textarea>
            <?php else: ?>
                <input class="rounded border px-4 py-2" name="<?= e($key) ?>" value="<?= e($settings[$key] ?? '') ?>">
            <?php endif; ?>
        </label>
    <?php endforeach; ?>
    <button class="rounded bg-brand-pink px-4 py-3 font-bold text-white">Simpan Setting</button>
</form>
<?php admin_footer(); ?>

