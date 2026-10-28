<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../repositories/user-repository.php";

requireRole('admin');

$user = getUserById((int) ($_GET['id'] ?? 0));

if ($user === null) {
  setFlash('error', 'Pengguna tidak ditemukan.');
  redirect("/pages/users/index.php");
}

$pageTitle = "Edit Pengguna";
$pageSubtitle = "Perbarui data dan role pengguna";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Pengguna - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/users/edit.css">
</head>
<body>
  <div class="app-shell">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>
        <form method="POST" action="../../actions/users/update.php">
          <input type="hidden" name="id" value="<?= $user['id'] ?>">
          <div class="form-card">
            <div class="form-section-title">Data Pengguna</div>
            <div class="form-row">
              <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="<?= invalidClass('name') ?>" value="<?= e(old('name', $user['name'])) ?>">
                <?= fieldError('name') ?>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="<?= invalidClass('email') ?>" value="<?= e(old('email', $user['email'])) ?>">
                <?= fieldError('email') ?>
              </div>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="<?= invalidClass('role') ?>">
                  <option value="member" <?= old('role', $user['role']) === 'member' ? 'selected' : '' ?>>Member</option>
                  <option value="admin" <?= old('role', $user['role']) === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
                <?= fieldError('role') ?>
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
