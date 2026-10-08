<?php $base=$base ?? '../../'; $sidebarUser=currentUser(); ?>
<aside class="app-sidebar">
  <div class="brand"><span class="logo-badge">PD</span> Perpustakaan Digital</div>
  <div class="nav-group-label">Menu Utama</div>
  <nav>
    <a href="<?= $base ?>index.php">⌂ Beranda</a>
    <a href="<?= $base ?>pages/books/index.php">▣ Buku</a>
    <a href="<?= $base ?>pages/categories/index.php">▰ Kategori</a>
    <a href="<?= $base ?>pages/authors/index.php">✎ Penulis</a>
    <?php if(($sidebarUser['role']??'member')==='admin'): ?><a href="<?= $base ?>pages/users/index.php">♙ Pengguna</a><?php endif; ?>
    <a href="<?= $base ?>pages/profile/edit.php">◎ Profil Saya</a>
    <a href="<?= $base ?>actions/auth/logout.php">↪ Keluar</a>
  </nav>
</aside>