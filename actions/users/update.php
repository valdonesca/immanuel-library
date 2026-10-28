<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../validations/user-validation.php";

requireRole('admin');

if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['update'])) {
  redirect("/pages/users/index.php");
}

$id = (int) ($_POST['id'] ?? 0);

if (getUserById($id) === null) {
  setFlash('error', 'Pengguna tidak ditemukan.');
  redirect("/pages/users/index.php");
}

$data = [
  "name"  => trim($_POST['name'] ?? ''),
  "email" => trim($_POST['email'] ?? ''),
  "role"  => $_POST['role'] ?? '',
];

$errors = validateUser($data, $id);

// Aturan otorisasi: admin tidak boleh mengubah role akunnya sendiri
// (mencegah tidak ada admin yang tersisa).
if ($id === currentUser()['id'] && $data['role'] !== currentUser()['role']) {
  $errors['role'] = "Anda tidak dapat mengubah role akun Anda sendiri.";
}

if (!empty($errors)) {
  setErrors($errors, $data);
  redirect("/pages/users/edit.php?id=" . $id);
}

// TODO: perbarui pengguna di database.
setFlash('success', 'Pengguna "' . $data['name'] . '" berhasil diperbarui.');
redirect("/pages/users/index.php");
