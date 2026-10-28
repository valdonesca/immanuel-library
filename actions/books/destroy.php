<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../repositories/book-repository.php";

requireRole('admin');

$id = (int) ($_GET['id'] ?? 0);
$book = getBookById($id);

if ($book === null) {
  setFlash('error', 'Buku tidak ditemukan.');
  redirect("/pages/books/index.php");
}

// TODO: hapus buku dari database.
setFlash('success', 'Buku "' . $book['title'] . '" berhasil dihapus.');
redirect("/pages/books/index.php");
