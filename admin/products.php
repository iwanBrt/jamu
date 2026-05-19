<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/_layout.php';

if (isset($_GET['delete'])) {
    $stmt = db()->prepare('DELETE FROM products WHERE id = ?');
    $stmt->execute([(int) $_GET['delete']]);
    redirect('products.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);
    $data = [
        $_POST['category_id'] ?: null,
        $_POST['name'] ?? '',
        $_POST['slug'] ?? '',
        $_POST['description'] ?? '',
        $_POST['image'] ?: 'logo.jpeg',
        (float) ($_POST['price'] ?? 0),
        (int) ($_POST['stock'] ?? 0),
        isset($_POST['is_best_seller']) ? 1 : 0,
        isset($_POST['is_premium']) ? 1 : 0,
        isset($_POST['is_active']) ? 1 : 0,
        (int) ($_POST['sort_order'] ?? 0),
    ];

    if ($id > 0) {
        $stmt = db()->prepare('UPDATE products SET category_id=?, name=?, slug=?, description=?, image=?, price=?, stock=?, is_best_seller=?, is_premium=?, is_active=?, sort_order=? WHERE id=?');
        $stmt->execute([...$data, $id]);
    } else {
        $stmt = db()->prepare('INSERT INTO products (category_id, name, slug, description, image, price, stock, is_best_seller, is_premium, is_active, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute($data);
    }

    redirect('products.php');
}

$categories = db()->query('SELECT * FROM categories ORDER BY sort_order, name')->fetchAll();
$edit = null;
if (isset($_GET['edit'])) {
    $stmt = db()->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([(int) $_GET['edit']]);
    $edit = $stmt->fetch();
}
$products = db()->query('SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON c.id = p.category_id ORDER BY p.is_best_seller DESC, p.sort_order ASC, p.id DESC')->fetchAll();

admin_header('Produk');
?>
<form method="post" class="mb-8 grid gap-4 rounded-lg bg-white p-6 shadow md:grid-cols-2">
    <input type="hidden" name="id" value="<?= e($edit['id'] ?? '') ?>">
    <input class="rounded border px-4 py-2" name="name" placeholder="Nama produk" required value="<?= e($edit['name'] ?? '') ?>">
    <input class="rounded border px-4 py-2" name="slug" placeholder="slug-produk" required value="<?= e($edit['slug'] ?? '') ?>">
    <select class="rounded border px-4 py-2" name="category_id">
        <option value="">Tanpa kategori</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?= e((string) $category['id']) ?>" <?= isset($edit['category_id']) && (int) $edit['category_id'] === (int) $category['id'] ? 'selected' : '' ?>><?= e($category['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <input class="rounded border px-4 py-2" name="image" placeholder="logo.jpeg / uploads/foto.jpg" value="<?= e($edit['image'] ?? 'logo.jpeg') ?>">
    <input class="rounded border px-4 py-2" type="number" name="price" placeholder="Harga" required value="<?= e($edit['price'] ?? '') ?>">
    <input class="rounded border px-4 py-2" type="number" name="stock" placeholder="Stok" value="<?= e($edit['stock'] ?? '0') ?>">
    <textarea class="rounded border px-4 py-2 md:col-span-2" name="description" placeholder="Deskripsi"><?= e($edit['description'] ?? '') ?></textarea>
    <input class="rounded border px-4 py-2" type="number" name="sort_order" placeholder="Urutan" value="<?= e($edit['sort_order'] ?? '0') ?>">
    <div class="flex flex-wrap gap-4 text-sm">
        <label><input type="checkbox" name="is_best_seller" <?= !empty($edit['is_best_seller']) ? 'checked' : '' ?>> Best seller</label>
        <label><input type="checkbox" name="is_premium" <?= !empty($edit['is_premium']) ? 'checked' : '' ?>> Premium</label>
        <label><input type="checkbox" name="is_active" <?= !isset($edit) || !empty($edit['is_active']) ? 'checked' : '' ?>> Aktif</label>
    </div>
    <button class="rounded bg-brand-pink px-4 py-3 font-bold text-white md:col-span-2"><?= $edit ? 'Update Produk' : 'Tambah Produk' ?></button>
</form>

<div class="overflow-x-auto rounded-lg bg-white shadow">
    <table class="w-full text-left text-sm">
        <thead class="bg-gray-100"><tr><th class="p-3">Produk</th><th class="p-3">Kategori</th><th class="p-3">Harga</th><th class="p-3">Status</th><th class="p-3">Aksi</th></tr></thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr class="border-t">
                    <td class="p-3 font-semibold"><?= e($product['name']) ?></td>
                    <td class="p-3"><?= e($product['category_name']) ?></td>
                    <td class="p-3"><?= rupiah($product['price']) ?></td>
                    <td class="p-3"><?= (int) $product['is_active'] === 1 ? 'Aktif' : 'Nonaktif' ?></td>
                    <td class="p-3"><a class="text-blue-600" href="?edit=<?= e((string) $product['id']) ?>">Edit</a> <a class="ml-3 text-red-600" onclick="return confirm('Hapus produk?')" href="?delete=<?= e((string) $product['id']) ?>">Hapus</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php admin_footer(); ?>

