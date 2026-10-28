<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../repositories/book-repository.php";
require_once __DIR__ . "/../../repositories/category-repository.php";
require_once __DIR__ . "/../../repositories/author-repository.php";

requireRole('admin');

$book = getBookById((int) ($_GET['id'] ?? 0));

if ($book === null) {
  setFlash('error', 'Buku tidak ditemukan.');
  redirect("/pages/books/index.php");
}

$categories = getCategories();
$authors = getAuthors();

$pageTitle = "Edit Buku";
$pageSubtitle = "Perbarui data buku, kategori, dan penulis";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Buku - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/books/edit.css">
</head>
<body>
  <div class="app-shell">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>
        <form method="POST" action="../../actions/books/update.php">
          <input type="hidden" name="id" value="<?= $book['id'] ?>">
          <div class="form-card" style="margin-bottom:20px;">
            <div class="form-section-title">Data Buku</div>
            <div class="form-group">
                <label for="title">Judul Buku</label>
                <input type="text" id="title" name="title" class="<?= invalidClass('title') ?>" value="<?= e(old('title', $book['title'])) ?>">
                <?= fieldError('title') ?>
              </div>
            <div class="form-row">
              <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" class="<?= invalidClass('isbn') ?>" value="<?= e(old('isbn', $book['isbn'])) ?>">
                <?= fieldError('isbn') ?>
              </div>
              <div class="form-group">
                <label for="year">Tahun Terbit</label>
                <input type="number" id="year" name="year" class="<?= invalidClass('year') ?>" value="<?= e(old('year', $book['year'])) ?>">
                <?= fieldError('year') ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="stock">Jumlah Stok</label>
                <input type="number" id="stock" name="stock" class="<?= invalidClass('stock') ?>" value="<?= e(old('stock', $book['stock'])) ?>">
                <?= fieldError('stock') ?>
              </div>
              <div class="form-group">
                <label for="category_id">Kategori</label>
                <select id="category_id" name="category_id" class="<?= invalidClass('category_id') ?>">
                  <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= (int) old('category_id', $book['category_id']) === $category['id'] ? 'selected' : '' ?>><?= e($category['name']) ?></option>
                  <?php endforeach; ?>
                </select>
                <?= fieldError('category_id') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="description">Deskripsi</label>
              <textarea id="description" name="description" rows="3" class="<?= invalidClass('description') ?>"><?= e(old('description', $book['description'])) ?></textarea>
              <?= fieldError('description') ?>
            </div>
          </div>

          <div class="form-card">
            <div class="form-section-title">Penulis Buku</div>
            <div class="form-group">
              <label>Pilih Penulis (bisa lebih dari satu)</label>
              <?php $selectedAuthors = array_map('intval', (array) old('author_ids', $book['author_ids'])); ?>
              <div class="checkbox-grid">
                <?php foreach ($authors as $author): ?>
                  <label class="checkbox-item">
                    <input type="checkbox" name="author_ids[]" value="<?= $author['id'] ?>" <?= in_array($author['id'], $selectedAuthors, true) ? 'checked' : '' ?>>
                    <?= e($author['name']) ?>
                  </label>
                <?php endforeach; ?>
              </div>
              <?= fieldError('author_ids') ?>
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
