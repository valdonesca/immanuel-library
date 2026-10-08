<?php require_once '../../config/bootstrap.php';
requireLogin('../auth/login.php');
require_once '../../repositories/book-repository.php';
$book = getBook((int) ($_GET['id'] ?? 0));
if (!$book) {
    flash('Buku tidak ditemukan.', 'error');
    redirect('index.php');
}
$base = '../../';
$pageTitle = 'Detail Buku';
$pageSubtitle = 'Detail buku'; ?><!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= e($book['title']) ?></title>
    <link rel="stylesheet" href="../../styles/books/show.css">
</head>

<body>
    <div class="app-shell"><?php require '../../components/admin/sidebar.php'; ?>
        <main class="app-main"><?php require '../../components/admin/topbar.php'; ?>
            <div class="app-content">
                <div class="form-card">
                    <h2><?= e($book['title']) ?></h2>
                    <p><b>ISBN:</b> <?= e($book['isbn']) ?></p>
                    <p><b>Tahun:</b> <?= $book['year'] ?> &nbsp; <b>Stok:</b> <?= $book['stock'] ?></p>
                    <p><b>Kategori:</b> <?= e($book['category']) ?></p>
                    <p><b>Penulis:</b> <?= e(implode(', ', $book['authors'])) ?></p>
                    <p><?= nl2br(e($book['description'])) ?></p><a href="edit.php?id=<?= $book['id'] ?>"
                        class="btn btn-primary">Edit</a> <a href="index.php" class="btn btn-outline">Kembali</a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>