<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../validations/book-validation.php";
require_once __DIR__ . "/../../repositories/book-repository.php";

requireRole('admin');

if ($_SERVER['REQUEST_METHOD'] !== "POST" || !isset($_POST['update'])) {
  redirect("/pages/books/index.php");
}

$id = (int) ($_POST['id'] ?? 0);

if (getBookById($id) === null) {
  setFlash('error', 'Buku tidak ditemukan.');
  redirect("/pages/books/index.php");
}

$data = [
  "title"       => trim($_POST['title'] ?? ''),
  "isbn"        => trim($_POST['isbn'] ?? ''),
  "year"        => trim($_POST['year'] ?? ''),
  "stock"       => trim($_POST['stock'] ?? ''),
  "category_id" => trim($_POST['category_id'] ?? ''),
  "description" => trim($_POST['description'] ?? ''),
  "author_ids"  => $_POST['author_ids'] ?? [],
];

$errors = validateBook($data);

if (!empty($errors)) {
  setErrors($errors, $data);
  redirect("/pages/books/edit.php?id=" . $id);
}

// TODO: perbarui buku di database.
setFlash('success', 'Buku "' . $data['title'] . '" berhasil diperbarui.');
redirect("/pages/books/index.php");
