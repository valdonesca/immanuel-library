<?php

/** Daftar kategori. $search memfilter berdasarkan nama. */
function getCategories(string $search = ''): array
{
  $categories = [
    ["id" => 1, "name" => "Fiksi",     "description" => "Novel dan cerita rekaan",        "total_books" => 4],
    ["id" => 2, "name" => "Sains",     "description" => "Buku ilmu pengetahuan alam",      "total_books" => 0],
    ["id" => 3, "name" => "Sejarah",   "description" => "Buku sejarah dan biografi",       "total_books" => 1],
    ["id" => 4, "name" => "Teknologi", "description" => "Buku pemrograman dan teknologi",  "total_books" => 0],
  ];

  if ($search !== '') {
    $categories = array_values(array_filter($categories, function ($category) use ($search) {
      return mb_stripos($category['name'], $search) !== false;
    }));
  }

  return $categories;
}

function getCategoryById(int $id): ?array
{
  foreach (getCategories() as $category) {
    if ($category['id'] === $id) {
      return $category;
    }
  }

  return null;
}
