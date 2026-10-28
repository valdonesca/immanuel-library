<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../repositories/user-repository.php";

requireLogin();

// Profil selalu milik pengguna yang sedang login (dari session).
$user = currentUser();
$profile = getProfile($user['id']);

$pageTitle = "Profil Saya";
$pageSubtitle = "Kelola data akun dan profil Anda";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Saya - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/profile/edit.css">
</head>
<body>
  <div class="app-shell">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>
        <form method="POST" action="../../actions/profile/update.php">
          <div class="form-card" style="margin-bottom:20px;">
            <div class="form-section-title">Data Akun</div>
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
              <label>Role</label>
              <input type="text" value="<?= e(ucfirst($user['role'])) ?>" disabled>
              <p class="form-help">Role hanya dapat diubah oleh Admin melalui menu Manajemen Pengguna.</p>
            </div>
          </div>

          <div class="form-card">
            <div class="form-section-title">Data Profil</div>
            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" class="<?= invalidClass('phone') ?>" value="<?= e(old('phone', $profile['phone'])) ?>">
                <?= fieldError('phone') ?>
              </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <input type="text" id="address" name="address" class="<?= invalidClass('address') ?>" value="<?= e(old('address', $profile['address'])) ?>">
                <?= fieldError('address') ?>
              </div>
            <div class="form-group">
              <label for="bio">Bio Singkat</label>
              <textarea id="bio" name="bio" rows="3" class="<?= invalidClass('bio') ?>"><?= e(old('bio', $profile['bio'])) ?></textarea>
              <?= fieldError('bio') ?>
            </div>
            <div class="form-actions">
              <a href="/pages/profile/edit.php" class="btn btn-outline">Batal</a>
              <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>
</html>
