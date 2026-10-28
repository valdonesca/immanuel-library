<?php require_once __DIR__ . "/../../helpers/auth.php"; ?>
<header>
    <nav class="navbar">
        <a href="/index.php" class="brand">
            <span class="logo-badge">PD</span>
            Perpustakaan Digital
        </a>
        <div class="nav-links">
            <a href="/index.php" class="active">Beranda</a>
            <a href="/pages/books/index.php">Katalog Buku</a>
            <a href="/pages/authors/index.php">Penulis</a>
        </div>
        <div class="nav-actions">
            <?php if (isLoggedIn()): ?>
                <span class="nav-user"><?= e(currentUser()['name']) ?></span>
                <form method="POST" action="/actions/auth/logout.php" class="logout-form">
                    <button type="submit" class="btn btn-outline btn-sm">Keluar</button>
                </form>
            <?php else: ?>
                <a href="/pages/auth/login.php" class="btn btn-outline btn-sm">Masuk</a>
                <a href="/pages/auth/register.php" class="btn btn-primary btn-sm">Daftar</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
