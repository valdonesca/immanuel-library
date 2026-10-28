<?php
// =============================================
// HELPER: PAGINATION
// =============================================

const PER_PAGE = 3; // jumlah data per halaman (ubah sesuai kebutuhan)

/**
 * Potong array menjadi satu halaman.
 *
 * @return array{data:array,page:int,per_page:int,total:int,total_pages:int,from:int,to:int}
 */
function paginate(array $items, int $page, int $perPage = PER_PAGE): array
{
  $total = count($items);
  $totalPages = max(1, (int) ceil($total / $perPage));
  $page = min(max(1, $page), $totalPages);
  $offset = ($page - 1) * $perPage;
  $data = array_slice($items, $offset, $perPage);

  return [
    "data"        => $data,
    "page"        => $page,
    "per_page"    => $perPage,
    "total"       => $total,
    "total_pages" => $totalPages,
    "from"        => $total === 0 ? 0 : $offset + 1,
    "to"          => $offset + count($data),
  ];
}

/** Halaman aktif dari ?page=... (default 1). */
function currentPage(): int
{
  return max(1, (int) ($_GET['page'] ?? 1));
}

/** URL ke halaman tertentu dengan mempertahankan search/filter di query string. */
function pageUrl(int $page): string
{
  $query = $_GET;
  $query['page'] = $page;

  return '?' . http_build_query($query);
}
