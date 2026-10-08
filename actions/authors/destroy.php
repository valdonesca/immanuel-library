<?php require_once '../../config/bootstrap.php';
requireLogin('../../pages/auth/login.php');
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['id']))
    redirect('../../pages/authors/index.php');
$id = (int) ($_GET['id'] ?? 0);
$d = db();
$d['authors'] = array_values(array_filter($d['authors'], fn($a) => (int) $a['id'] !== $id));
foreach ($d['books'] as &$b)
    $b['author_ids'] = array_values(array_filter($b['author_ids'] ?? [], fn($x) => (int) $x !== $id));
unset($b);
saveDb($d);
flash('Penulis berhasil dihapus.');
redirect('../../pages/authors/index.php');
