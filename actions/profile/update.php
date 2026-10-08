<?php require_once '../../config/bootstrap.php';
$me = requireLogin('../../pages/auth/login.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update']))
    redirect('../../pages/profile/edit.php');
$d = db();
foreach ($d['users'] as &$u)
    if ((int) $u['id'] === (int) $me['id']) {
        $u['name'] = trim($_POST['name'] ?? $u['name']);
        $u['email'] = strtolower(trim($_POST['email'] ?? $u['email']));
        $u['phone'] = trim($_POST['phone'] ?? '');
        $u['address'] = trim($_POST['address'] ?? '');
        $u['bio'] = trim($_POST['bio'] ?? '');
    }
unset($u);
saveDb($d);
flash('Profil berhasil diperbarui.');
redirect('../../pages/profile/edit.php');