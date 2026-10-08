<?php require_once '../../config/bootstrap.php';
requireLogin('../../pages/auth/login.php');
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['id']))
    redirect('../../pages/books/index.php');
$id = (int) ($_GET['id'] ?? 0);
$d = db();
$d['books'] = array_values(array_filter($d['books'], fn($b) => (int) $b['id'] !== $id));
saveDb($d);
flash('Buku berhasil dihapus.');
redirect('../../pages/books/index.php');
