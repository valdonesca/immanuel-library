<?php require_once '../../config/bootstrap.php';
requireLogin('../../pages/auth/login.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['store']))
    redirect('../../pages/books/create.php');
$title = trim($_POST['title'] ?? '');
$isbn = trim($_POST['isbn'] ?? '');
$year = (int) ($_POST['year'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);
$cat = (int) ($_POST['category_id'] ?? 0);
$desc = trim($_POST['description'] ?? '');
$authors = array_values(array_unique(array_map('intval', $_POST['author_ids'] ?? [])));
if ($title === '' || $year < 0 || $stock < 0 || !findById(db()['categories'], $cat)) {
    flash('Data buku belum valid.', 'error');
    redirect('../../pages/books/create.php');
}
$d = db();
$d['books'][] = ['id' => nextId($d['books']), 'title' => $title, 'isbn' => $isbn, 'year' => $year, 'stock' => $stock, 'category_id' => $cat, 'description' => $desc, 'author_ids' => $authors];
saveDb($d);
flash('Buku berhasil ditambahkan.');
redirect('../../pages/books/index.php');
