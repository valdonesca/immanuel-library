<?php

/** Daftar penulis. $search memfilter berdasarkan nama (tidak peka huruf besar/kecil). */
function getAuthors(string $search = ''): array
{
  $authors = [
    ["id" => 1, "name" => "Andrea Hirata",         "bio" => "Penulis asal Belitung, dikenal lewat novel Laskar Pelangi.",                "total_books" => 1],
    ["id" => 2, "name" => "Tere Liye",              "bio" => "Penulis novel populer Indonesia, dikenal lewat serial Bumi.",               "total_books" => 1],
    ["id" => 3, "name" => "J.K. Rowling",           "bio" => "Penulis asal Inggris, pencipta serial Harry Potter.",                       "total_books" => 1],
    ["id" => 4, "name" => "Pramoedya Ananta Toer",  "bio" => "Sastrawan Indonesia, terkenal lewat Tetralogi Buru.",                      "total_books" => 2],
    ["id" => 5, "name" => "Sapardi Djoko Damono",   "bio" => "Penyair dan sastrawan Indonesia, dikenal lewat puisi-puisi liris.",        "total_books" => 1],
  ];

  if ($search !== '') {
    $authors = array_values(array_filter($authors, function ($author) use ($search) {
      return mb_stripos($author['name'], $search) !== false;
    }));
  }

  return $authors;
}

function getAuthorById(int $id): ?array
{
  foreach (getAuthors() as $author) {
    if ($author['id'] === $id) {
      return $author;
    }
  }

  return null;
}
