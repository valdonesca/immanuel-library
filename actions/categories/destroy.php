<?php require_once '../../config/bootstrap.php';
requireLogin('../../pages/auth/login.php');
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['id']))
    redirect('../../pages/categories/index.php');
$id = (int) ($_GET['id'] ?? 0);
$d = db();
foreach ($d['books'] as $b)
    if ((int) $b['category_id'] === $id) {
        flash('Kategori tidak bisa dihapus karena masih dipakai buku.', 'error');
        redirect('../../pages/categories/index.php');
    }
$d['categories'] = array_values(array_filter($d['categories'], fn($c) => (int) $c['id'] !== $id));
saveDb($d);
flash('Kategori berhasil dihapus.');
redirect('../../pages/categories/index.php');
