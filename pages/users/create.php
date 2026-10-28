<?php
require_once __DIR__ . "/../../helpers/auth.php";

requireRole('admin');

$pageTitle = "Tambah Pengguna";
$pageSubtitle = "Buat akun pengguna baru beserta perannya";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Pengguna - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/users/create.css">
</head>
<body>
  <div class="app-shell">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>
        <form method="POST" action="../../actions/users/store.php">
          <div class="form-card">
            <div class="form-section-title">Data Pengguna</div>
            <div class="form-row">
              <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="<?= invalidClass('name') ?>" value="<?= e(old('name', '')) ?>" placeholder="Contoh: Siti Aminah">
                <?= fieldError('name') ?>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="<?= invalidClass('email') ?>" value="<?= e(old('email', '')) ?>" placeholder="nama@sekolah.sch.id">
                <?= fieldError('email') ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" class="<?= invalidClass('password') ?>" placeholder="Minimal 8 karakter">
                <?= fieldError('password') ?>
              </div>
              <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="<?= invalidClass('role') ?>">
                  <option value="member" <?= old('role', 'member') === 'member' ? 'selected' : '' ?>>Member</option>
                  <option value="admin" <?= old('role', 'member') === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
                <?= fieldError('role') ?>
              </div>
            </div>

            <div class="form-actions">
              <a href="index.php" class="btn btn-outline">Batal</a>
              <button type="submit" name="store" class="btn btn-primary">Simpan Pengguna</button>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
