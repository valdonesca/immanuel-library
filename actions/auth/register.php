<?php require_once '../../config/bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    redirect('../../pages/auth/register.php');
$name = trim($_POST['name'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$p = (string) ($_POST['password'] ?? '');
$pc = (string) ($_POST['password_confirmation'] ?? '');
if (strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($p) < 8 || $p !== $pc) {
    flash('Data registrasi tidak valid. Nama minimal 2 karakter, email harus valid, dan kata sandi minimal 8 karakter serta harus sama.', 'error');
    redirect('../../pages/auth/register.php');
}
$d = db();
foreach ($d['users'] as $u)
    if (strtolower($u['email']) === $email) {
        flash('Email sudah terdaftar.', 'error');
        redirect('../../pages/auth/register.php');
    }
$d['users'][] = ['id' => nextId($d['users']), 'name' => $name, 'email' => $email, 'password' => password_hash($p, PASSWORD_DEFAULT), 'role' => 'member', 'phone' => '', 'address' => '', 'bio' => ''];
saveDb($d);
flash('Registrasi berhasil. Silakan masuk.');
redirect('../../pages/auth/login.php');
