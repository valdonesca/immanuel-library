<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../validations/category-validation.php";

requireRole('admin');

if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['store'])) {
  redirect("/pages/categories/index.php");
}

$data = [
  "name"        => trim($_POST['name'] ?? ''),
  "description" => trim($_POST['description'] ?? ''),
];

$errors = validateCategory($data);

if (!empty($errors)) {
  setErrors($errors, $data);
  redirect("/pages/categories/create.php");
}

// TODO: simpan kategori ke database.
setFlash('success', 'Kategori "' . $data['name'] . '" berhasil ditambahkan.');
redirect("/pages/categories/index.php");
