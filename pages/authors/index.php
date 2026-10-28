<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../helpers/pagination.php";
require_once __DIR__ . "/../../repositories/author-repository.php";

requireLogin();

$search = trim($_GET['search'] ?? '');
$pagination = paginate(getAuthors($search), currentPage());

$authors = $pagination['data'];

$pageTitle = "Manajemen Penulis";
$pageSubtitle = "Kelola data penulis yang terdaftar di sistem";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Penulis - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/authors/index.css">
</head>
<body>
  <div class="app-shell">
  <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
    <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>

        <div class="toolbar">
          <form method="GET" action="" class="toolbar-filters">
            <div class="search-box">
              <svg class="icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
              <input type="text" name="search" class="search-input" placeholder="Cari nama penulis..." value="<?= e($search) ?>">
            </div>
            <button type="submit" class="btn btn-outline btn-sm">Cari</button>
          </form>
          <?php if (isAdmin()): ?>
            <a href="create.php" class="btn btn-primary">+ Tambah Penulis</a>
          <?php endif; ?>
        </div>

        <div class="data-card">
          <table class="data-table">
            <thead>
              <tr>
                <th>Nama Penulis</th>
                <th>Jumlah Buku Ditulis</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($authors as $author): ?>
                <tr>
                  <td>
                    <div class="cell-primary">
                      <span class="cell-thumb"><svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></span>
                      <?= e($author['name']) ?>
                    </div>
                  </td>
                  <td><span class="badge badge-muted"><?= $author['total_books'] ?> buku</span></td>
                  <td>
                    <div class="cell-actions">
                      <?php if (isAdmin()): ?>
                        <a href="edit.php?id=<?= $author['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                        <a href="../../actions/authors/destroy.php?id=<?= $author['id'] ?>" class="btn btn-danger btn-sm"
                          onclick="return confirm('Yakin ingin menghapus penulis ini?')">Hapus</a>
                      <?php else: ?>
                        <span style="color:var(--ink-soft);">&mdash;</span>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach ?>
              <?php if (empty($authors)): ?>
                <tr><td colspan="3" style="text-align:center;color:var(--ink-soft);">Tidak ada penulis yang cocok.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <?php require_once __DIR__ . "/../../components/pagination.php" ?>
      </div>
    </main>
  </div>
</body>
</html>
