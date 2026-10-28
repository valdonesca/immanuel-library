<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../validations/user-validation.php";

requireRole('admin');

if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['store'])) {
  redirect("/pages/users/index.php");
}

$data = [
  "name"     => trim($_POST['name'] ?? ''),
  "email"    => trim($_POST['email'] ?? ''),
  "password" => $_POST['password'] ?? '',
  "role"     => $_POST['role'] ?? '',
];

$errors = validateUser($data);

if (!empty($errors)) {
  setErrors($errors, $data);
  redirect("/pages/users/create.php");
}

// Jangan pernah menyimpan password asli: simpan hash-nya.
$passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

// TODO: simpan pengguna (dengan $passwordHash) ke database.
setFlash('success', 'Pengguna "' . $data['name'] . '" berhasil ditambahkan.');
redirect("/pages/users/index.php");
