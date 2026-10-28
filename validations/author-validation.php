<?php
require_once __DIR__ . "/../repositories/author-repository.php";

function validateAuthor(array $data, ?int $ignoreId = null): array
{
  $errors = [];

  if ($data['name'] === '') {
    $errors['name'] = "Nama penulis wajib diisi.";
  } elseif (mb_strlen($data['name']) < 3 || mb_strlen($data['name']) > 100) {
    $errors['name'] = "Nama penulis harus 3-100 karakter.";
  } else {
    foreach (getAuthors() as $author) {
      if ($author['id'] !== $ignoreId && mb_strtolower($author['name']) === mb_strtolower($data['name'])) {
        $errors['name'] = "Penulis dengan nama tersebut sudah terdaftar.";
        break;
      }
    }
  }

  if (mb_strlen($data['bio']) > 500) {
    $errors['bio'] = "Biografi maksimal 500 karakter.";
  }

  return $errors;
}
