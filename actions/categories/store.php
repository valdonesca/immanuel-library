<?php require_once '../../config/bootstrap.php';
requireLogin('../../pages/auth/login.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['store']))
    redirect('../../pages/categories/create.php');
$d = db();
$name = trim($_POST['name'] ?? '');
$desc = trim($_POST['description'] ?? '');
if ($name === '') {
    flash('Nama kategori wajib diisi.', 'error');
    redirect('../../pages/categories/create.php');
}
$d['categories'][] = ['id' => nextId($d['categories']), 'name' => $name, 'description' => $desc];
saveDb($d);
flash('Kategori berhasil ditambahkan.');
redirect('../../pages/categories/index.php');
