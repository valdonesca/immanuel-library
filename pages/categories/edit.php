<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../repositories/category-repository.php";

requireRole('admin');

$category = getCategoryById((int) ($_GET['id'] ?? 0));

if ($category === null) {
  setFlash('error', 'Kategori tidak ditemukan.');
  redirect("/pages/categories/index.php");
}

$pageTitle = "Edit Kategori";
$pageSubtitle = "Perbarui data kategori";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kategori - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/categories/edit.css">
</head>
<body>
  <div class="app-shell">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>
        <form method="POST" action="../../actions/categories/update.php">
          <input type="hidden" name="id" value="<?= $category['id'] ?>">
          <div class="form-card">
            <div class="form-section-title">Data Kategori</div>
            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" id="name" name="name" class="<?= invalidClass('name') ?>" value="<?= e(old('name', $category['name'])) ?>">
                <?= fieldError('name') ?>
              </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea id="description" name="description" rows="3" class="<?= invalidClass('description') ?>"><?= e(old('description', $category['description'])) ?></textarea>
              <?= fieldError('description') ?>
            </div>

            <div class="form-actions">
              <a href="index.php" class="btn btn-outline">Batal</a>
              <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
