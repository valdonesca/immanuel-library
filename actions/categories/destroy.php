<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../repositories/category-repository.php";

requireRole('admin');

$id = (int) ($_GET['id'] ?? 0);
$category = getCategoryById($id);

if ($category === null) {
  setFlash('error', 'Kategori tidak ditemukan.');
  redirect("/pages/categories/index.php");
}

if ($category['total_books'] > 0) {
  setFlash('error', 'Kategori "' . $category['name'] . '" tidak dapat dihapus karena masih dipakai oleh ' . $category['total_books'] . ' buku.');
  redirect("/pages/categories/index.php");
}

// TODO: hapus kategori dari database.
setFlash('success', 'Kategori "' . $category['name'] . '" berhasil dihapus.');
redirect("/pages/categories/index.php");
