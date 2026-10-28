<?php
// =============================================
// HELPER: AUTHENTICATION & AUTHORIZATION
// =============================================

require_once __DIR__ . "/session.php";

const HOME_PATH  = "/pages/books/index.php";
const LOGIN_PATH = "/pages/auth/login.php";

/* ---------- AUTHENTICATION ---------- */

/** Simpan data pengguna ke session (tanpa password). */
function loginUser(array $user): void
{
  // Ganti ID session setelah login untuk mencegah session fixation.
  session_regenerate_id(true);

  $_SESSION['user'] = [
    "id"    => $user['id'],
    "name"  => $user['name'],
    "email" => $user['email'],
    "role"  => $user['role'],
  ];
}

function logoutUser(): void
{
  $_SESSION = [];

  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
  }

  session_destroy();
}

function isLoggedIn(): bool
{
  return isset($_SESSION['user']);
}

function currentUser(): ?array
{
  return $_SESSION['user'] ?? null;
}

/** Halaman yang hanya boleh dibuka setelah login. */
function requireLogin(): void
{
  if (!isLoggedIn()) {
    setFlash('error', 'Silakan masuk terlebih dahulu.');
    redirect(LOGIN_PATH);
  }
}

/** Halaman khusus tamu (login/register): yang sudah login dilempar ke beranda. */
function requireGuest(): void
{
  if (isLoggedIn()) {
    redirect(HOME_PATH);
  }
}

/* ---------- AUTHORIZATION ---------- */

function hasRole(string ...$roles): bool
{
  return isLoggedIn() && in_array($_SESSION['user']['role'], $roles, true);
}

function isAdmin(): bool
{
  return hasRole('admin');
}

/**
 * Batasi halaman/aksi berdasarkan role.
 * Contoh: requireRole('admin');
 */
function requireRole(string ...$roles): void
{
  requireLogin();

  if (!hasRole(...$roles)) {
    setFlash('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    redirect(HOME_PATH);
  }
}

/** Inisial nama untuk avatar, misalnya "Budi Santoso" => "BS". */
function initials(string $name): string
{
  $words = preg_split('/\s+/', trim($name));
  $result = '';

  foreach (array_slice($words, 0, 2) as $word) {
    $result .= mb_strtoupper(mb_substr($word, 0, 1));
  }

  return $result;
}
