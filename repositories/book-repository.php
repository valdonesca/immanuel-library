<?php

/**
 * Daftar buku.
 * $search   : cari berdasarkan judul
 * $category : filter berdasarkan nama kategori (kosong = semua)
 */
function getBooks(string $search = '', string $category = ''): array
{
  $books = [
    [
      "id" => 1,
      "title" => "Laskar Pelangi",
      "isbn" => "978-979-1227-78-0",
      "category_id" => 1,
      "category" => "Fiksi",
      "year" => 2005,
      "stock" => 12,
      "description" => "Kisah sepuluh anak Belitung yang berjuang menuntut ilmu di sekolah sederhana.",
      "author_ids" => [1],
      "authors" => ["Andrea Hirata"],
    ],
    [
      "id" => 2,
      "title" => "Bumi",
      "isbn" => "978-602-03-3295-6",
      "category_id" => 1,
      "category" => "Fiksi",
      "year" => 2014,
      "stock" => 8,
      "description" => "Petualangan Raib, Seli, dan Ali di dunia paralel.",
      "author_ids" => [2],
      "authors" => ["Tere Liye"],
    ],
    [
      "id" => 3,
      "title" => "Harry Potter dan Batu Bertuah",
      "isbn" => "978-979-3062-79-2",
      "category_id" => 1,
      "category" => "Fiksi",
      "year" => 1997,
      "stock" => 5,
      "description" => "Anak yatim piatu yang menemukan dirinya adalah penyihir.",
      "author_ids" => [3],
      "authors" => ["J.K. Rowling"],
    ],
    [
      "id" => 4,
      "title" => "Bumi Manusia",
      "isbn" => "978-979-9731-23-4",
      "category_id" => 3,
      "category" => "Sejarah",
      "year" => 1980,
      "stock" => 6,
      "description" => "Kisah Minke pada masa pergerakan nasional di Hindia Belanda.",
      "author_ids" => [4],
      "authors" => ["Pramoedya Ananta Toer"],
    ],
    [
      "id" => 5,
      "title" => "Antologi Rasa Nusantara",
      "isbn" => "978-602-1234-56-7",
      "category_id" => 1,
      "category" => "Fiksi",
      "year" => 2021,
      "stock" => 4,
      "description" => "Kumpulan puisi dan cerita pendek dari berbagai penulis Nusantara.",
      "author_ids" => [4, 5],
      "authors" => ["Pramoedya Ananta Toer", "Sapardi Djoko Damono"],
    ],
  ];

  if ($search !== '') {
    $books = array_filter($books, function ($book) use ($search) {
      return mb_stripos($book['title'], $search) !== false;
    });
  }

  if ($category !== '') {
    $books = array_filter($books, function ($book) use ($category) {
      return $book['category'] === $category;
    });
  }

  return array_values($books);
}

function getBookById(int $id): ?array
{
  foreach (getBooks() as $book) {
    if ($book['id'] === $id) {
      return $book;
    }
  }

  return null;
}
