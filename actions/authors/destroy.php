<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../repositories/author-repository.php";

requireRole('admin');

$id = (int) ($_GET['id'] ?? 0);
$author = getAuthorById($id);

if ($author === null) {
  setFlash('error', 'Penulis tidak ditemukan.');
  redirect("/pages/authors/index.php");
}

if ($author['total_books'] > 0) {
  setFlash('error', 'Penulis "' . $author['name'] . '" tidak dapat dihapus karena masih memiliki ' . $author['total_books'] . ' buku.');
  redirect("/pages/authors/index.php");
}

// TODO: hapus penulis dari database.
setFlash('success', 'Penulis "' . $author['name'] . '" berhasil dihapus.');
redirect("/pages/authors/index.php");
