<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../repositories/author-repository.php";

requireRole('admin');

$author = getAuthorById((int) ($_GET['id'] ?? 0));

if ($author === null) {
  setFlash('error', 'Penulis tidak ditemukan.');
  redirect("/pages/authors/index.php");
}

$pageTitle = "Edit Penulis";
$pageSubtitle = "Perbarui data penulis";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Penulis - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/authors/edit.css">
</head>
<body>
  <div class="app-shell">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>
        <form method="POST" action="../../actions/authors/update.php">
          <input type="hidden" name="id" value="<?= $author['id'] ?>">
          <div class="form-card">
            <div class="form-section-title">Data Penulis</div>
            <div class="form-group">
                <label for="name">Nama Penulis</label>
                <input type="text" id="name" name="name" class="<?= invalidClass('name') ?>" value="<?= e(old('name', $author['name'])) ?>">
                <?= fieldError('name') ?>
              </div>
            <div class="form-group">
              <label for="bio">Biografi Singkat</label>
              <textarea id="bio" name="bio" rows="3" class="<?= invalidClass('bio') ?>"><?= e(old('bio', $author['bio'])) ?></textarea>
              <?= fieldError('bio') ?>
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
