<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../validations/profile-validation.php";

requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['update'])) {
  redirect("/pages/profile/edit.php");
}

// ID diambil dari session, BUKAN dari form, sehingga pengguna
// hanya bisa mengubah profilnya sendiri.
$userId = currentUser()['id'];

$data = [
  "name"    => trim($_POST['name'] ?? ''),
  "email"   => trim($_POST['email'] ?? ''),
  "phone"   => trim($_POST['phone'] ?? ''),
  "address" => trim($_POST['address'] ?? ''),
  "bio"     => trim($_POST['bio'] ?? ''),
];

$errors = validateProfile($data, $userId);

if (!empty($errors)) {
  setErrors($errors, $data);
  redirect("/pages/profile/edit.php");
}

// TODO: perbarui data pengguna & profil di database.
// Sementara, perbarui session agar nama di topbar ikut berubah.
$_SESSION['user']['name'] = $data['name'];
$_SESSION['user']['email'] = $data['email'];

setFlash('success', 'Profil berhasil diperbarui.');
redirect("/pages/profile/edit.php");
