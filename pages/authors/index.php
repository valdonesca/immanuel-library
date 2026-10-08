<?php require_once '../../config/bootstrap.php';
requireLogin('../auth/login.php');
require_once '../../repositories/author-repository.php';
$search = trim($_GET['search'] ?? '');
$authors = getAuthors($search);
$base = '../../';
$pageTitle = 'Manajemen Penulis';
$pageSubtitle = 'Kelola data penulis buku'; ?><!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="../../styles/authors/index.css">
</head>

<body>
    <div class="app-shell"><?php require '../../components/admin/sidebar.php'; ?>
        <main class="app-main"><?php require '../../components/admin/topbar.php'; ?>
            <div class="app-content">
                <div class="toolbar">
                    <form method="GET" action="index.php" class="toolbar-filters"><input name="search"
                            value="<?= e($search) ?>" class="search-input" placeholder="Cari nama penulis..."><button
                            class="btn btn-outline btn-sm">Cari</button></form><a href="create.php"
                        class="btn btn-primary">+ Tambah Penulis</a>
                </div>
                <div class="data-card">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Bio</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody><?php foreach ($authors as $a): ?>
                                <tr>
                                    <td><?= e($a['name']) ?></td>
                                    <td><?= e($a['bio']) ?></td>
                                    <td><a href="edit.php?id=<?= $a['id'] ?>" class="btn btn-outline btn-sm">Edit</a> <a
                                            onclick="return confirm('Hapus penulis ini?')"
                                            href="../../actions/authors/destroy.php?id=<?= $a['id'] ?>"
                                            class="btn btn-danger btn-sm">Hapus</a></td>
                                </tr><?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>