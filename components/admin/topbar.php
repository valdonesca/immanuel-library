<?php
$topbarUser = currentUser();
$flash = getFlash();
$userName = $topbarUser['name'] ?? 'Admin';
$initial = strtoupper(substr(trim($userName), 0, 1));
?>
<header class="app-topbar">
    <div class="page-title">
        <h1><?= e($pageTitle ?? 'Dashboard') ?></h1>
        <p><?= e($pageSubtitle ?? 'Sistem Manajemen Perpustakaan') ?></p>
    </div>

    <div class="topbar-user">
        <span class="avatar"><?= e($initial) ?></span>
        <span><?= e($userName) ?></span>
    </div>
</header>

<?php if ($flash): ?>
    <div class="app-content">
        <div class="form-card" style="width:100%; margin-bottom:0; <?= $flash['type'] === 'error' ? 'border-color:#ef4444;' : '' ?>">
            <?= e($flash['message']) ?>
        </div>
    </div>
<?php endif; ?>
