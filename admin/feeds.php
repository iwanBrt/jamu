<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/_layout.php';

if (isset($_GET['delete'])) {
    db()->prepare('DELETE FROM feeds WHERE id = ?')->execute([(int) $_GET['delete']]);
    redirect('feeds.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    $data = [
        $_POST['title'] ?? '',
        $_POST['description'] ?? '',
        $_POST['image'] ?: 'logo.jpeg',
        $_POST['source_type'] ?? 'TIKTOK',
        $_POST['source_url'] ?? '',
        (int) ($_POST['likes'] ?? 0),
        (int) ($_POST['views'] ?? 0),
        isset($_POST['is_popular']) ? 1 : 0,
        isset($_POST['is_active']) ? 1 : 0,
        (int) ($_POST['sort_order'] ?? 0),
    ];

    if ($id > 0) {
        db()->prepare('UPDATE feeds SET title=?, description=?, image=?, source_type=?, source_url=?, likes=?, views=?, is_popular=?, is_active=?, sort_order=? WHERE id=?')->execute([...$data, $id]);
    } else {
        db()->prepare('INSERT INTO feeds (title, description, image, source_type, source_url, likes, views, is_popular, is_active, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')->execute($data);
    }

    redirect('feeds.php');
}

$edit = null;
if (isset($_GET['edit'])) {
    $stmt = db()->prepare('SELECT * FROM feeds WHERE id = ?');
    $stmt->execute([(int) $_GET['edit']]);
    $edit = $stmt->fetch();
}
$feeds = db()->query('SELECT * FROM feeds ORDER BY sort_order, id DESC')->fetchAll();

admin_header('Konten Viral');
?>
<form method="post" class="mb-8 grid gap-4 rounded-lg bg-white p-6 shadow md:grid-cols-2">
    <input type="hidden" name="id" value="<?= e($edit['id'] ?? '') ?>">
    <input class="rounded border px-4 py-2" name="title" placeholder="Judul konten" required value="<?= e($edit['title'] ?? '') ?>">
    <select class="rounded border px-4 py-2" name="source_type">
        <?php foreach (['TIKTOK', 'INSTAGRAM', 'YOUTUBE', 'OTHER'] as $type): ?>
            <option value="<?= e($type) ?>" <?= ($edit['source_type'] ?? 'TIKTOK') === $type ? 'selected' : '' ?>><?= e($type) ?></option>
        <?php endforeach; ?>
    </select>
    <input class="rounded border px-4 py-2 md:col-span-2" name="source_url" placeholder="https://..." required value="<?= e($edit['source_url'] ?? '') ?>">
    <input class="rounded border px-4 py-2" name="image" placeholder="logo.jpeg / uploads/foto.jpg" value="<?= e($edit['image'] ?? 'logo.jpeg') ?>">
    <input class="rounded border px-4 py-2" type="number" name="sort_order" placeholder="Urutan" value="<?= e($edit['sort_order'] ?? '0') ?>">
    <input class="rounded border px-4 py-2" type="number" name="likes" placeholder="Likes" value="<?= e($edit['likes'] ?? '0') ?>">
    <input class="rounded border px-4 py-2" type="number" name="views" placeholder="Views" value="<?= e($edit['views'] ?? '0') ?>">
    <textarea class="rounded border px-4 py-2 md:col-span-2" name="description" placeholder="Deskripsi"><?= e($edit['description'] ?? '') ?></textarea>
    <div class="flex flex-wrap gap-4 text-sm">
        <label><input type="checkbox" name="is_popular" <?= !empty($edit['is_popular']) ? 'checked' : '' ?>> Popular</label>
        <label><input type="checkbox" name="is_active" <?= !isset($edit) || !empty($edit['is_active']) ? 'checked' : '' ?>> Aktif</label>
    </div>
    <button class="rounded bg-brand-pink px-4 py-3 font-bold text-white md:col-span-2"><?= $edit ? 'Update Konten' : 'Tambah Konten' ?></button>
</form>

<div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($feeds as $feed): ?>
        <div class="rounded-lg bg-white p-4 shadow">
            <img src="../<?= e($feed['image']) ?>" alt="<?= e($feed['title']) ?>" class="mb-4 h-40 w-full rounded object-cover">
            <h3 class="font-bold"><?= e($feed['title']) ?></h3>
            <p class="text-sm text-gray-500"><?= e($feed['source_type']) ?> - <?= compact_number($feed['likes']) ?> likes</p>
            <div class="mt-4"><a class="text-blue-600" href="?edit=<?= e((string) $feed['id']) ?>">Edit</a> <a class="ml-3 text-red-600" onclick="return confirm('Hapus konten?')" href="?delete=<?= e((string) $feed['id']) ?>">Hapus</a></div>
        </div>
    <?php endforeach; ?>
</div>
<?php admin_footer(); ?>
