<?php

// Semua akun contoh memakai kata sandi: password123
// (disimpan sebagai hash bcrypt, bukan teks asli).
const DEMO_PASSWORD_HASH = '$2y$10$fhRn3hZ2.kIJiMZ9JaXQe.l0IcSg9k.OGpf0rB6wSymtAcJ3E31AC';

/** Daftar pengguna. $search memfilter berdasarkan nama atau email. */
function getUsers(string $search = ''): array
{
  $users = [
    ["id" => 1, "name" => "Admin Utama",     "email" => "admin@ski.sch.id",               "role" => "admin",  "password" => DEMO_PASSWORD_HASH],
    ["id" => 2, "name" => "Budi Santoso",    "email" => "budi.santoso@siswa.ski.sch.id",  "role" => "member", "password" => DEMO_PASSWORD_HASH],
    ["id" => 3, "name" => "Siti Aminah",     "email" => "siti.aminah@siswa.ski.sch.id",   "role" => "member", "password" => DEMO_PASSWORD_HASH],
    ["id" => 4, "name" => "Richard Marcell", "email" => "richard.m@ski.sch.id",           "role" => "admin",  "password" => DEMO_PASSWORD_HASH],
  ];

  if ($search !== '') {
    $users = array_filter($users, function ($user) use ($search) {
      return mb_stripos($user['name'], $search) !== false
        || mb_stripos($user['email'], $search) !== false;
    });
  }

  return array_values($users);
}

function getUserById(int $id): ?array
{
  foreach (getUsers() as $user) {
    if ($user['id'] === $id) {
      return $user;
    }
  }

  return null;
}

function getUserByEmail(string $email): ?array
{
  foreach (getUsers() as $user) {
    if (mb_strtolower($user['email']) === mb_strtolower($email)) {
      return $user;
    }
  }

  return null;
}

/** Profil tambahan milik satu pengguna (kosong jika belum diisi). */
function getProfile(int $userId): array
{
  $profiles = [
    2 => [
      "user_id" => 2,
      "phone"   => "0812-3456-7890",
      "address" => "Jl. Merdeka No. 21, Pontianak, Kalimantan Barat",
      "bio"     => "Murid kelas XI TKJ yang gemar membaca novel fiksi dan buku pengembangan diri.",
    ],
  ];

  return $profiles[$userId] ?? ["user_id" => $userId, "phone" => "", "address" => "", "bio" => ""];
}
