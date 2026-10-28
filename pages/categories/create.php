<?php
require_once __DIR__ . "/../../helpers/auth.php";

requireRole('admin');

$pageTitle = "Tambah Kategori";
$pageSubtitle = "Buat kategori baru untuk mengelompokkan buku";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kategori - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/categories/create.css">
</head>
<body>
  <div class="app-shell">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>
        <form method="POST" action="../../actions/categories/store.php">
          <div class="form-card">
            <div class="form-section-title">Data Kategori</div>
            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" id="name" name="name" class="<?= invalidClass('name') ?>" value="<?= e(old('name', '')) ?>" placeholder="Contoh: Fiksi">
                <?= fieldError('name') ?>
              </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea id="description" name="description" rows="3" class="<?= invalidClass('description') ?>" placeholder="Deskripsi singkat kategori"><?= e(old('description', '')) ?></textarea>
              <?= fieldError('description') ?>
            </div>

            <div class="form-actions">
              <a href="index.php" class="btn btn-outline">Batal</a>
              <button type="submit" name="store" class="btn btn-primary">Simpan Kategori</button>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
