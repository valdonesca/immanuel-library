<?php
require_once __DIR__ . "/../repositories/user-repository.php";

const VALID_ROLES = ['admin', 'member'];

/**
 * Validasi tambah/edit pengguna oleh admin.
 * Saat edit ($ignoreId diisi) kata sandi tidak diminta.
 */
function validateUser(array $data, ?int $ignoreId = null): array
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
    if ($existing !== null && $existing['id'] !== $ignoreId) {
      $errors['email'] = "Email sudah dipakai pengguna lain.";
    }
  }

  if ($ignoreId === null) {
    if ($data['password'] === '') {
      $errors['password'] = "Kata sandi wajib diisi.";
    } elseif (strlen($data['password']) < 8) {
      $errors['password'] = "Kata sandi minimal 8 karakter.";
    }
  }

  if (!in_array($data['role'], VALID_ROLES, true)) {
    $errors['role'] = "Role harus admin atau member.";
  }

  return $errors;
}
