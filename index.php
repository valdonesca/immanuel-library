<?php require_once 'config/bootstrap.php';
$d = db();
$u = currentUser();
$base = ''; ?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Beranda - Perpustakaan Digital</title>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body><?php require_once 'components/landing/header.php'; ?>
    <section class="hero">
        <div class="hero-text"><span class="hero-badge">SISTEM MANAJEMEN PERPUSTAKAAN</span>
            <h1>Kelola Koleksi Buku Sekolah <span>Lebih Rapi &amp; Modern</span></h1>
            <p>Kelola buku, penulis, kategori, dan pengguna secara terpusat dengan penyimpanan persisten.</p>
            <div class="hero-cta"><a href="pages/books/index.php" class="btn btn-primary">Lihat Katalog Buku</a><a
                    href="<?= $u ? 'pages/profile/edit.php' : 'pages/auth/login.php' ?>"
                    class="btn btn-outline"><?= $u ? 'Profil Saya' : 'Masuk ke Akun' ?></a></div>
        </div>
    </section>
    <section class="section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number"><?= count($d['books']) ?></div>
                <div class="stat-label">Total Judul Buku</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($d['categories']) ?></div>
                <div class="stat-label">Kategori Buku</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($d['authors']) ?></div>
                <div class="stat-label">Penulis Terdaftar</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($d['users']) ?></div>
                <div class="stat-label">Pengguna</div>
            </div>
        </div>
    </section><?php require_once 'components/landing/footer.php'; ?>
</body>

</html>