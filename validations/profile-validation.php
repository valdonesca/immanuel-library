<?php
require_once __DIR__ . "/../repositories/user-repository.php";

function validateProfile(array $data, int $userId): array
{
  $errors = [];

  if ($data['name'] === '') {
    $errors['name'] = "Nama lengkap wajib diisi.";
  } elseif (mb_strlen($data['name']) < 3 || mb_strlen($data['name']) > 100) {
    $errors['name'] = "Nama harus 3-100 karakter.";
  }

  if ($data['email'] === '') {
    $errors['email'] = "Email wajib diisi.";
  } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Format email tidak valid.";
  } else {
    $existing = getUserByEmail($data['email']);
    if ($existing !== null && $existing['id'] !== $userId) {
      $errors['email'] = "Email sudah dipakai pengguna lain.";
    }
  }

  // Telepon boleh kosong; jika diisi: 8-15 karakter angka/spasi/tanda hubung/+.
  if ($data['phone'] !== '' && !preg_match('/^\+?[0-9\s-]{8,15}$/', $data['phone'])) {
    $errors['phone'] = "Nomor telepon tidak valid (8-15 digit).";
  }

  if (mb_strlen($data['address']) > 255) {
    $errors['address'] = "Alamat maksimal 255 karakter.";
  }

  if (mb_strlen($data['bio']) > 300) {
    $errors['bio'] = "Bio maksimal 300 karakter.";
  }

  return $errors;
}
