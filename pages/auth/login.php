<?php
require_once __DIR__ . "/../../helpers/auth.php";

requireGuest();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/auth/login.css">
</head>
<body>

  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="auth-logo">
        <span class="logo-badge">PD</span>
        Perpustakaan Digital
      </div>
      <h1>Selamat Datang Kembali</h1>
      <p class="auth-subtitle">Masuk untuk mengelola koleksi buku perpustakaan.</p>

      <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>
      <?php $loginError = getErrors()['login'] ?? null; ?>
      <?php if ($loginError !== null): ?>
        <div class="alert alert-error" role="alert"><?= e($loginError) ?></div>
      <?php endif; ?>

      <form method="POST" action="../../actions/auth/login.php" novalidate>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="<?= invalidClass('email') ?>" value="<?= e(old('email')) ?>" placeholder="nama@sekolah.sch.id">
          <?= fieldError('email') ?>
        </div>
        <div class="form-group">
          <label for="password">Kata Sandi</label>
          <input type="password" id="password" name="password" class="<?= invalidClass('password') ?>" placeholder="Masukkan kata sandi">
          <?= fieldError('password') ?>
        </div>
        <button type="submit" name="login" class="btn btn-primary btn-block">Masuk</button>
      </form>

      <p class="form-footer-link">
        Belum punya akun? <a href="register.php">Daftar di sini</a>
      </p>
    </div>
  </div>
</body>
</html>
