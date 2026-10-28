<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../helpers/pagination.php";
require_once __DIR__ . "/../../repositories/category-repository.php";

requireRole('admin');

$search = trim($_GET['search'] ?? '');
$pagination = paginate(getCategories($search), currentPage());

$categories = $pagination['data'];

$pageTitle = "Manajemen Kategori";
$pageSubtitle = "Kelola kategori untuk mengelompokkan buku";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Kategori - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/categories/index.css">
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
              <input type="text" name="search" class="search-input" placeholder="Cari nama kategori..." value="<?= e($search) ?>">
            </div>
            <button type="submit" class="btn btn-outline btn-sm">Cari</button>
          </form>
          <?php if (isAdmin()): ?>
            <a href="create.php" class="btn btn-primary">+ Tambah Kategori</a>
          <?php endif; ?>
        </div>

        <div class="data-card">
          <table class="data-table">
            <thead>
              <tr>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categories as $category): ?>
                <tr>
                  <td>
                    <div class="cell-primary">
                      <span class="cell-thumb"><svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"/></svg></span>
                      <?= e($category['name']) ?>
                    </div>
                  </td>
                  <td><?= e($category['description']) ?></td>
                  <td><span class="badge badge-muted"><?= $category['total_books'] ?> buku</span></td>
                  <td>
                    <div class="cell-actions">
                      <?php if (isAdmin()): ?>
                        <a href="edit.php?id=<?= $category['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                        <a href="../../actions/categories/destroy.php?id=<?= $category['id'] ?>" class="btn btn-danger btn-sm"
                          onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
                      <?php else: ?>
                        <span style="color:var(--ink-soft);">&mdash;</span>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach ?>
              <?php if (empty($categories)): ?>
                <tr><td colspan="4" style="text-align:center;color:var(--ink-soft);">Tidak ada kategori yang cocok.</td></tr>
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
