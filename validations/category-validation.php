<?php
require_once __DIR__ . "/../repositories/category-repository.php";

/** $ignoreId dipakai saat edit supaya nama miliknya sendiri tidak dianggap duplikat. */
function validateCategory(array $data, ?int $ignoreId = null): array
{
  $errors = [];

  if ($data['name'] === '') {
    $errors['name'] = "Nama kategori wajib diisi.";
  } elseif (mb_strlen($data['name']) < 3 || mb_strlen($data['name']) > 50) {
    $errors['name'] = "Nama kategori harus 3-50 karakter.";
  } else {
    foreach (getCategories() as $category) {
      if ($category['id'] !== $ignoreId && mb_strtolower($category['name']) === mb_strtolower($data['name'])) {
        $errors['name'] = "Nama kategori sudah ada.";
        break;
      }
    }
  }

  if (mb_strlen($data['description']) > 255) {
    $errors['description'] = "Deskripsi maksimal 255 karakter.";
  }

  return $errors;
}
