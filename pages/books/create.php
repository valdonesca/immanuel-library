<?php require_once '../../config/bootstrap.php';
requireLogin('../auth/login.php');
require_once '../../repositories/category-repository.php';
require_once '../../repositories/author-repository.php';
$categories = getCategories();
$authors = getAuthors();
$base = '../../';
$pageTitle = 'Tambah Buku';
$pageSubtitle = 'Form untuk menambah data buku baru'; ?><!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../../styles/books/create.css">
</head>
<body>
<div class="app-shell"><?php require '../../components/admin/sidebar.php'; ?>
    <main class="app-main"><?php require '../../components/admin/topbar.php'; ?>
        <div class="app-content">
            <form method="POST" action="../../actions/books/store.php">
                <div class="form-card">
                    <div class="form-group"><label>Judul Buku</label><input required name="title"></div>
                    <div class="form-row">
                        <div class="form-group"><label>ISBN</label><input name="isbn"></div>
                        <div class="form-group"><label>Tahun</label><input required type="number" name="year"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group"><label>Stok</label><input required min="0" type="number" name="stock"></div>
                        <div class="form-group"><label>Kategori</label>
                            <select required name="category_id">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= e($c['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group"><label>Deskripsi</label><textarea name="description" rows="4"></textarea></div>
                </div>
                <div class="form-card" style="margin-top:20px">
                    <div class="form-section-title">Penulis</div>
                    <?php foreach ($authors as $a): ?>
                        <label style="display:block;margin:8px 0"><input type="checkbox" name="author_ids[]" value="<?= $a['id'] ?>"> <?= e($a['name']) ?></label>
                    <?php endforeach; ?>
                    <div class="form-actions"><a href="index.php" class="btn btn-outline">Batal</a><button type="submit" name="store" value="1" class="btn btn-primary">Simpan Buku</button></div>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
