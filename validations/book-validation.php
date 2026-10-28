<?php
require_once __DIR__ . "/../repositories/category-repository.php";
require_once __DIR__ . "/../repositories/author-repository.php";

function validateBook(array $data): array
{
  $errors = [];

  if ($data['title'] === '') {
    $errors['title'] = "Judul buku wajib diisi.";
  } elseif (mb_strlen($data['title']) > 150) {
    $errors['title'] = "Judul maksimal 150 karakter.";
  }

  // ISBN: 10-17 karakter berisi angka, tanda hubung, atau huruf X (ISBN-10).
  if ($data['isbn'] === '') {
    $errors['isbn'] = "ISBN wajib diisi.";
  } elseif (!preg_match('/^[0-9Xx-]{10,17}$/', $data['isbn'])) {
    $errors['isbn'] = "ISBN harus 10-17 karakter (angka dan tanda hubung).";
  }

  $thisYear = (int) date('Y');
  if ($data['year'] === '') {
    $errors['year'] = "Tahun terbit wajib diisi.";
  } elseif (!ctype_digit($data['year'])) {
    $errors['year'] = "Tahun terbit harus berupa angka.";
  } elseif ((int) $data['year'] < 1000 || (int) $data['year'] > $thisYear) {
    $errors['year'] = "Tahun terbit harus antara 1000 dan $thisYear.";
  }

  if ($data['stock'] === '') {
    $errors['stock'] = "Jumlah stok wajib diisi.";
  } elseif (!ctype_digit($data['stock'])) {
    $errors['stock'] = "Stok harus berupa bilangan bulat 0 atau lebih.";
  } elseif ((int) $data['stock'] > 9999) {
    $errors['stock'] = "Stok maksimal 9999.";
  }

  if ($data['category_id'] === '') {
    $errors['category_id'] = "Kategori wajib dipilih.";
  } elseif (getCategoryById((int) $data['category_id']) === null) {
    $errors['category_id'] = "Kategori yang dipilih tidak ditemukan.";
  }

  if (mb_strlen($data['description']) > 1000) {
    $errors['description'] = "Deskripsi maksimal 1000 karakter.";
  }

  if (empty($data['author_ids'])) {
    $errors['author_ids'] = "Pilih minimal satu penulis.";
  } else {
    foreach ($data['author_ids'] as $authorId) {
      if (getAuthorById((int) $authorId) === null) {
        $errors['author_ids'] = "Ada penulis yang tidak valid.";
        break;
      }
    }
  }

  return $errors;
}
