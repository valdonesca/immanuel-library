<?php
require_once __DIR__ . "/../../helpers/auth.php";

requireRole('admin');

$pageTitle = "Tambah Penulis";
$pageSubtitle = "Daftarkan penulis baru ke sistem";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Penulis - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/authors/create.css">
</head>
<body>
  <div class="app-shell">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>
        <form method="POST" action="../../actions/authors/store.php">
          <div class="form-card">
            <div class="form-section-title">Data Penulis</div>
            <div class="form-group">
                <label for="name">Nama Penulis</label>
                <input type="text" id="name" name="name" class="<?= invalidClass('name') ?>" value="<?= e(old('name', '')) ?>" placeholder="Contoh: Tere Liye">
                <?= fieldError('name') ?>
              </div>
            <div class="form-group">
              <label for="bio">Biografi Singkat</label>
              <textarea id="bio" name="bio" rows="3" class="<?= invalidClass('bio') ?>" placeholder="Biografi singkat penulis"><?= e(old('bio', '')) ?></textarea>
              <?= fieldError('bio') ?>
            </div>
            <div class="form-actions">
              <a href="index.php" class="btn btn-outline">Batal</a>
              <button type="submit" name="store" class="btn btn-primary">Simpan Penulis</button>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
