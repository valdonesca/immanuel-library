<?php
require_once __DIR__ . "/../../helpers/auth.php";
require_once __DIR__ . "/../../helpers/pagination.php";
require_once __DIR__ . "/../../repositories/user-repository.php";

requireRole('admin');

$search = trim($_GET['search'] ?? '');
$pagination = paginate(getUsers($search), currentPage());

$users = $pagination['data'];

$pageTitle = "Manajemen Pengguna";
$pageSubtitle = "Daftar seluruh pengguna beserta perannya (role)";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Pengguna - Perpustakaan Digital</title>
  <link rel="stylesheet" href="../../styles/users/index.css">
</head>
<body>
  <div class="app-shell">
  <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="app-main">
    <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="app-content">
        <?php require_once __DIR__ . "/../../components/admin/alert.php" ?>

        <div class="toolbar">
          <form method="GET" action="" class="toolbar-filters">
            <div class="search-box">
              <svg class="icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3"/></svg>
              <input type="text" name="search" class="search-input" placeholder="Cari nama atau email pengguna..." value="<?= e($search) ?>">
            </div>
            <button type="submit" class="btn btn-outline btn-sm">Cari</button>
          </form>
          <?php if (isAdmin()): ?>
            <a href="create.php" class="btn btn-primary">+ Tambah Pengguna</a>
          <?php endif; ?>
        </div>

        <div class="data-card">
          <table class="data-table">
            <thead>
              <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td>
                    <div class="cell-primary">
                      <span class="cell-thumb"><svg class="icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 19.5v-1a4.5 4.5 0 0 0-4.5-4.5h-5A4.5 4.5 0 0 0 5 18.5v1"/><circle cx="12" cy="7.5" r="4"/></svg></span>
                      <?= e($user['name']) ?>
                    </div>
                  </td>
                  <td><?= e($user['email']) ?></td>
                  <td>
                    <?php if ($user['role'] === 'admin'): ?>
                      <span class="badge badge-admin">Admin</span>
                    <?php else: ?>
                      <span class="badge badge-member">Member</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="cell-actions">
                      <?php if (isAdmin()): ?>
                        <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                        <a href="../../actions/users/destroy.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm"
                          onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</a>
                      <?php else: ?>
                        <span style="color:var(--ink-soft);">&mdash;</span>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              <?php endforeach ?>
              <?php if (empty($users)): ?>
                <tr><td colspan="4" style="text-align:center;color:var(--ink-soft);">Tidak ada pengguna yang cocok.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

        <?php require_once __DIR__ . "/../../components/pagination.php" ?>
      </div>
    </main>
  </div>
</body>
</html>
