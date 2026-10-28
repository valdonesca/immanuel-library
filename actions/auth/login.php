<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../validations/auth-validation.php";
require_once __DIR__ . "/../../repositories/user-repository.php";

if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['login'])) {
  redirect(LOGIN_PATH);
}

$data = [
  "email"    => trim($_POST['email'] ?? ''),
  "password" => $_POST['password'] ?? '',
];

$errors = validateLogin($data);

if (!empty($errors)) {
  setErrors($errors, $data);
  redirect(LOGIN_PATH);
}

$user = getUserByEmail($data['email']);

// Selalu jalankan password_verify supaya waktu respons relatif sama
// (tidak membocorkan apakah email terdaftar atau tidak).
$passwordOk = password_verify($data['password'], $user['password'] ?? DEMO_PASSWORD_HASH);

if ($user === null || !$passwordOk) {
  // Pesan sengaja dibuat umum, tidak menyebut mana yang salah.
  setErrors(["login" => "Email atau kata sandi salah."], $data);
  redirect(LOGIN_PATH);
}

loginUser($user);
setFlash('success', "Selamat datang, " . $user['name'] . "!");
redirect(HOME_PATH);
