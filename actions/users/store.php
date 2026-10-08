<?php require_once '../../config/bootstrap.php';
$me = requireLogin('../../pages/auth/login.php');
if ($me['role'] !== 'admin') {
    flash('Hanya admin yang dapat mengelola pengguna.', 'error');
    redirect('../../pages/users/index.php');
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['store']))
    redirect('../../pages/users/create.php');
$d = db();
$name = trim($_POST['name'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$p = (string) ($_POST['password'] ?? '');
$role = in_array($_POST['role'] ?? 'member', ['admin', 'member'], true) ? $_POST['role'] : 'member';
if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($p) < 8) {
    flash('Data pengguna belum valid.', 'error');
    redirect('../../pages/users/create.php');
}
foreach ($d['users'] as $u)
    if (strtolower($u['email']) === $email) {
        flash('Email sudah digunakan.', 'error');
        redirect('../../pages/users/create.php');
    }
$d['users'][] = ['id' => nextId($d['users']), 'name' => $name, 'email' => $email, 'password' => password_hash($p, PASSWORD_DEFAULT), 'role' => $role, 'phone' => '', 'address' => '', 'bio' => ''];
saveDb($d);
flash('Pengguna berhasil ditambahkan.');
redirect('../../pages/users/index.php');