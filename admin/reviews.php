<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/_layout.php';

if (isset($_GET['delete'])) {
    db()->prepare('DELETE FROM reviews WHERE id = ?')->execute([(int) $_GET['delete']]);
    redirect('reviews.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    $data = [
        $_POST['product_id'] ?: null,
        $_POST['customer_name'] ?? '',
        $_POST['customer_role'] ?? '',
        (int) ($_POST['rating'] ?? 5),
        $_POST['comment'] ?? '',
        isset($_POST['is_approved']) ? 1 : 0,
    ];

    if ($id > 0) {
        db()->prepare('UPDATE reviews SET product_id=?, customer_name=?, customer_role=?, rating=?, comment=?, is_approved=? WHERE id=?')->execute([...$data, $id]);
    } else {
        db()->prepare('INSERT INTO reviews (product_id, customer_name, customer_role, rating, comment, is_approved) VALUES (?, ?, ?, ?, ?, ?)')->execute($data);
    }

    redirect('reviews.php');
}

$products = db()->query('SELECT id, name FROM products ORDER BY name')->fetchAll();
$edit = null;
if (isset($_GET['edit'])) {
    $stmt = db()->prepare('SELECT * FROM reviews WHERE id = ?');
    $stmt->execute([(int) $_GET['edit']]);
    $edit = $stmt->fetch();
}
$reviews = db()->query('SELECT r.*, p.name AS product_name FROM reviews r LEFT JOIN products p ON p.id = r.product_id ORDER BY r.id DESC')->fetchAll();

admin_header('Testimoni');
?>
<form method="post" class="mb-8 grid gap-4 rounded-lg bg-white p-6 shadow md:grid-cols-2">
    <input type="hidden" name="id" value="<?= e($edit['id'] ?? '') ?>">
    <input class="rounded border px-4 py-2" name="customer_name" placeholder="Nama pelanggan" required value="<?= e($edit['customer_name'] ?? '') ?>">
    <input class="rounded border px-4 py-2" name="customer_role" placeholder="Role / asal" value="<?= e($edit['customer_role'] ?? '') ?>">
    <select class="rounded border px-4 py-2" name="product_id">
        <option value="">Tanpa produk</option>
        <?php foreach ($products as $product): ?>
            <option value="<?= e((string) $product['id']) ?>" <?= isset($edit['product_id']) && (int) $edit['product_id'] === (int) $product['id'] ? 'selected' : '' ?>><?= e($product['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <input class="rounded border px-4 py-2" type="number" min="1" max="5" name="rating" value="<?= e($edit['rating'] ?? '5') ?>">
    <textarea class="rounded border px-4 py-2 md:col-span-2" name="comment" placeholder="Isi testimoni" required><?= e($edit['comment'] ?? '') ?></textarea>
    <label class="text-sm"><input type="checkbox" name="is_approved" <?= !isset($edit) || !empty($edit['is_approved']) ? 'checked' : '' ?>> Tampilkan di landing</label>
    <button class="rounded bg-brand-pink px-4 py-3 font-bold text-white md:col-span-2"><?= $edit ? 'Update Testimoni' : 'Tambah Testimoni' ?></button>
</form>

<div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($reviews as $review): ?>
        <div class="rounded-lg bg-white p-5 shadow">
            <p class="mb-2 font-bold"><?= e($review['customer_name']) ?></p>
            <p class="mb-4 text-sm text-gray-500"><?= e($review['customer_role'] ?: $review['product_name']) ?></p>
            <p class="text-sm text-gray-700">"<?= e($review['comment']) ?>"</p>
            <div class="mt-4"><a class="text-blue-600" href="?edit=<?= e((string) $review['id']) ?>">Edit</a> <a class="ml-3 text-red-600" onclick="return confirm('Hapus testimoni?')" href="?delete=<?= e((string) $review['id']) ?>">Hapus</a></div>
        </div>
    <?php endforeach; ?>
</div>
<?php admin_footer(); ?>
