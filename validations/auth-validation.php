<?php
require_once __DIR__ . "/../repositories/user-repository.php";

function validateLogin(array $data): array
{
  $errors = [];

  if ($data['email'] === '') {
    $errors['email'] = "Email wajib diisi.";
  } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Format email tidak valid.";
  }

  if ($data['password'] === '') {
    $errors['password'] = "Kata sandi wajib diisi.";
  }

  return $errors;
}

function validateRegister(array $data): array
{
  $errors = [];

  if ($data['name'] === '') {
    $errors['name'] = "Nama lengkap wajib diisi.";
  } elseif (mb_strlen($data['name']) < 3) {
    $errors['name'] = "Nama minimal 3 karakter.";
  } elseif (mb_strlen($data['name']) > 100) {
    $errors['name'] = "Nama maksimal 100 karakter.";
  }

  if ($data['email'] === '') {
    $errors['email'] = "Email wajib diisi.";
  } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Format email tidak valid.";
  } elseif (getUserByEmail($data['email']) !== null) {
    $errors['email'] = "Email sudah terdaftar.";
  }

  if ($data['password'] === '') {
    $errors['password'] = "Kata sandi wajib diisi.";
  } elseif (strlen($data['password']) < 8) {
    $errors['password'] = "Kata sandi minimal 8 karakter.";
  }

  if ($data['password_confirmation'] === '') {
    $errors['password_confirmation'] = "Ulangi kata sandi wajib diisi.";
  } elseif ($data['password'] !== $data['password_confirmation']) {
    $errors['password_confirmation'] = "Konfirmasi kata sandi tidak cocok.";
  }

  return $errors;
}
