<?php $topbarUser = currentUser();
$flash = getFlash(); ?>
<header class="bg-white shadow p-4 mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-xl font-bold text-slate-800"><?= e($pageTitle ?? 'Dashboard') ?></h1>
        <p class="text-sm text-slate-500"><?= e($pageSubtitle ?? 'Sistem Manajemen Perpustakaan') ?></p>
    </div>
    <div class="flex items-center gap-2">
        <span class="text-sm font-medium text-slate-700"><?= e($topbarUser['name'] ?? 'Admin') ?></span>
    </div>
</header>
<?php if ($flash): ?>
    <div class="app-content">
        <div class="form-card" style="margin-bottom:16px;<?= $flash['type'] === 'error' ? 'border-color:#ef4444;' : '' ?>">
            <?= e($flash['message']) ?></div>
    </div><?php endif; ?>