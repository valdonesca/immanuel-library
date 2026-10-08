<?php require_once '../../config/bootstrap.php';
$me = requireLogin('../../pages/auth/login.php');
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !isset($_GET['id']))
    redirect('../../pages/users/index.php');
if ($me['role'] !== 'admin') {
    flash('Hanya admin yang dapat mengelola pengguna.', 'error');
    redirect('../../pages/users/index.php');
}
$id = (int) ($_GET['id'] ?? 0);
if ($id === (int) $me['id']) {
    flash('Akun yang sedang digunakan tidak dapat dihapus.', 'error');
    redirect('../../pages/users/index.php');
}
$d = db();
$d['users'] = array_values(array_filter($d['users'], fn($u) => (int) $u['id'] !== $id));
saveDb($d);
flash('Pengguna berhasil dihapus.');
redirect('../../pages/users/index.php');