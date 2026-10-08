<?php require_once '../../config/bootstrap.php';
$me = requireLogin('../../pages/auth/login.php');
if ($me['role'] !== 'admin') {
    flash('Hanya admin yang dapat mengelola pengguna.', 'error');
    redirect('../../pages/users/index.php');
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update']))
    redirect('../../pages/users/index.php');
$id = (int) ($_POST['id'] ?? 0);
$d = db();
foreach ($d['users'] as &$u)
    if ((int) $u['id'] === $id) {
        $u['name'] = trim($_POST['name'] ?? $u['name']);
        $u['email'] = strtolower(trim($_POST['email'] ?? $u['email']));
        $u['role'] = in_array($_POST['role'] ?? $u['role'], ['admin', 'member'], true) ? $_POST['role'] : $u['role'];
        if (trim($_POST['password'] ?? '') !== '')
            $u['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
unset($u);
saveDb($d);
flash('Pengguna berhasil diperbarui.');
redirect('../../pages/users/index.php');