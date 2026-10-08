<?php require_once '../../config/bootstrap.php';
requireLogin('../../pages/auth/login.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update']))
    redirect('../../pages/authors/index.php');
$id = (int) ($_POST['id'] ?? 0);
$d = db();
foreach ($d['authors'] as &$a)
    if ((int) $a['id'] === $id) {
        $a['name'] = trim($_POST['name'] ?? '');
        $a['bio'] = trim($_POST['bio'] ?? '');
    }
unset($a);
saveDb($d);
flash('Penulis berhasil diperbarui.');
redirect('../../pages/authors/index.php');
