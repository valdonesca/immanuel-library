<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../repositories/user-repository.php";

requireRole('admin');

$id = (int) ($_GET['id'] ?? 0);
$user = getUserById($id);

if ($user === null) {
  setFlash('error', 'Pengguna tidak ditemukan.');
  redirect("/pages/users/index.php");
}

// Aturan otorisasi: admin tidak boleh menghapus akunnya sendiri.
if ($id === currentUser()['id']) {
  setFlash('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
  redirect("/pages/users/index.php");
}

// TODO: hapus pengguna dari database.
setFlash('success', 'Pengguna "' . $user['name'] . '" berhasil dihapus.');
redirect("/pages/users/index.php");
