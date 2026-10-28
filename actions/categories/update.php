<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../validations/category-validation.php";

requireRole('admin');

if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['update'])) {
  redirect("/pages/categories/index.php");
}

$id = (int) ($_POST['id'] ?? 0);

if (getCategoryById($id) === null) {
  setFlash('error', 'Kategori tidak ditemukan.');
  redirect("/pages/categories/index.php");
}

$data = [
  "name"        => trim($_POST['name'] ?? ''),
  "description" => trim($_POST['description'] ?? ''),
];

$errors = validateCategory($data, $id);

if (!empty($errors)) {
  setErrors($errors, $data);
  redirect("/pages/categories/edit.php?id=" . $id);
}

// TODO: perbarui kategori di database.
setFlash('success', 'Kategori "' . $data['name'] . '" berhasil diperbarui.');
redirect("/pages/categories/index.php");
