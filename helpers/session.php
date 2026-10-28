<?php
// =============================================
// HELPER: SESSION, FLASH MESSAGE, ERROR & OLD INPUT
// =============================================

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

/** Escape output supaya aman dari XSS. */
function e($value): string
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/** Pindahkan pengguna ke halaman lain lalu hentikan script. */
function redirect(string $path): void
{
  header("Location: " . $path);
  exit;
}

/**
 * Ambil data flash dari session sekali saja:
 * data dipindah ke variabel static lalu dihapus dari session,
 * jadi hanya tampil di satu request berikutnya.
 */
function pullFlash(string $key)
{
  static $cache = [];

  if (!array_key_exists($key, $cache)) {
    $cache[$key] = $_SESSION[$key] ?? null;
    unset($_SESSION[$key]);
  }

  return $cache[$key];
}

/** Pesan satu kali tampil. $type: "success" atau "error". */
function setFlash(string $type, string $message): void
{
  $_SESSION['flash'] = ["type" => $type, "message" => $message];
}

function getFlash(): ?array
{
  return pullFlash('flash');
}

/** Simpan error validasi + input lama (password jangan pernah disimpan). */
function setErrors(array $errors, array $old = []): void
{
  unset($old['password'], $old['password_confirmation']);

  $_SESSION['errors'] = $errors;
  $_SESSION['old'] = $old;
}

function getErrors(): array
{
  return pullFlash('errors') ?? [];
}

/** Nilai input sebelumnya (dipakai agar form tidak kosong lagi saat error). */
function old(string $key, $default = '')
{
  $old = pullFlash('old') ?? [];

  return $old[$key] ?? $default;
}

/** Cetak pesan error untuk satu field (kosong jika tidak ada error). */
function fieldError(string $field): string
{
  $errors = getErrors();

  if (!isset($errors[$field])) {
    return '';
  }

  return '<p class="field-error">' . e($errors[$field]) . '</p>';
}

/** Class tambahan agar input yang error diberi garis merah. */
function invalidClass(string $field): string
{
  $errors = getErrors();

  return isset($errors[$field]) ? 'is-invalid' : '';
}
