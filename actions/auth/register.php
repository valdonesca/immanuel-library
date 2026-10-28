<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../validations/auth-validation.php";
require_once __DIR__ . "/../../repositories/user-repository.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['register'])) {
  redirect("/pages/auth/register.php");
}

$data = [
  "name"                  => trim($_POST['name'] ?? ''),
  "email"                 => trim($_POST['email'] ?? ''),
  "password"              => $_POST['password'] ?? '',
  "password_confirmation" => $_POST['password_confirmation'] ?? '',
];

$errors = validateRegister($data);

if (!empty($errors)) {
  setErrors($errors, $data);
  redirect("/pages/auth/register.php");
}

// Role TIDAK diambil dari form: pendaftar baru selalu "member".
// Ini penting agar orang tidak bisa mendaftar sebagai admin lewat form.
$newUser = [
  "id"       => count(getUsers()) + 1,
  "name"     => $data['name'],
  "email"    => $data['email'],
  "role"     => "member",
  "password" => password_hash($data['password'], PASSWORD_DEFAULT),
];

// TODO: simpan $newUser ke database ketika repository sudah memakai MySQL.
// Sementara, pengguna baru langsung dimasuki ke session.
loginUser($newUser);
setFlash('success', "Akun berhasil dibuat. Selamat datang, " . $newUser['name'] . "!");
redirect(HOME_PATH);
