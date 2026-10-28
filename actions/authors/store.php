<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../validations/author-validation.php";

requireRole('admin');

if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['store'])) {
  redirect("/pages/authors/index.php");
}

$data = [
  "name" => trim($_POST['name'] ?? ''),
  "bio"  => trim($_POST['bio'] ?? ''),
];

$errors = validateAuthor($data);

if (!empty($errors)) {
  setErrors($errors, $data);
  redirect("/pages/authors/create.php");
}

// TODO: simpan penulis ke database.
setFlash('success', 'Penulis "' . $data['name'] . '" berhasil ditambahkan.');
redirect("/pages/authors/index.php");
