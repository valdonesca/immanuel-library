<?php
require_once __DIR__ . "/../../helpers/auth.php";

requireGuest();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/auth/register.css">
</head>
<body>

  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">
        <span class="logo-badge">PD</span>
        Perpustakaan Digital
      </div>
      <h1>Buat Akun Baru</h1>
      <p class="auth-subtitle">Daftar untuk mulai meminjam dan mengelola buku.</p>

      <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>

      <form method="POST" action="../../actions/auth/register.php" novalidate>
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" class="<?= invalidClass('name') ?>" value="<?= e(old('name')) ?>" placeholder="Contoh: Budi Santoso">
          <?= fieldError('name') ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="<?= invalidClass('email') ?>" value="<?= e(old('email')) ?>" placeholder="nama@sekolah.sch.id">
          <?= fieldError('email') ?>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" id="password" name="password" class="<?= invalidClass('password') ?>" placeholder="Minimal 8 karakter">
            <?= fieldError('password') ?>
          </div>
          <div class="form-group">
            <label for="password_confirmation">Ulangi Kata Sandi</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="<?= invalidClass('password_confirmation') ?>" placeholder="Ulangi kata sandi">
            <?= fieldError('password_confirmation') ?>
          </div>
        </div>

        <button type="submit" name="register" class="btn btn-primary btn-block">Daftar</button>
      </form>

      <p class="form-footer-link">
        Sudah punya akun? <a href="login.php">Masuk di sini</a>
      </p>
    </div>
  </div>
</body>
</html>
