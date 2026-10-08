<?php require_once '../../config/bootstrap.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    redirect('../../pages/auth/login.php');
$email = trim($_POST['email'] ?? '');
$password = (string) ($_POST['password'] ?? '');
foreach (db()['users'] as $u) {
    if (strtolower($u['email']) === strtolower($email) && password_verify($password, $u['password'])) {
        loginUser((int) $u['id']);
        flash('Berhasil masuk.');
        redirect('../../pages/books/index.php');
    }
}
flash('Email atau kata sandi salah.', 'error');
redirect('../../pages/auth/login.php');
