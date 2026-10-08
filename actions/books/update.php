<?php require_once '../../config/bootstrap.php';
requireLogin('../../pages/auth/login.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update']))
    redirect('../../pages/books/index.php');
$id = (int) ($_POST['id'] ?? 0);
$d = db();
$i = array_search($id, array_column($d['books'], 'id'));
if ($i === false) {
    flash('Buku tidak ditemukan.', 'error');
    redirect('../../pages/books/index.php');
}
$title = trim($_POST['title'] ?? '');
$cat = (int) ($_POST['category_id'] ?? 0);
$year = (int) ($_POST['year'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);
if ($title === '' || $year < 0 || $stock < 0 || !findById($d['categories'], $cat)) {
    flash('Data buku belum valid.', 'error');
    redirect('../../pages/books/edit.php?id=' . $id);
}
$d['books'][$i] = array_merge($d['books'][$i], ['title' => $title, 'isbn' => trim($_POST['isbn'] ?? ''), 'year' => $year, 'stock' => $stock, 'category_id' => $cat, 'description' => trim($_POST['description'] ?? ''), 'author_ids' => array_values(array_unique(array_map('intval', $_POST['author_ids'] ?? [])))]);
saveDb($d);
flash('Buku berhasil diperbarui.');
redirect('../../pages/books/index.php');
