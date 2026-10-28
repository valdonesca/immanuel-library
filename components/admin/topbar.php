<?php $authUser = currentUser(); ?>
<header class="app-topbar">
  <div class="page-title">
    <h1><?= e($pageTitle) ?></h1>
    <p><?= e($pageSubtitle) ?></p>
  </div>
  <div class="topbar-user">
    <span class="avatar"><?= e(initials($authUser['name'])) ?></span>
    <div>
      <?= e($authUser['name']) ?><br>
      <span class="badge <?= $authUser['role'] === 'admin' ? 'badge-admin' : 'badge-member' ?>" style="margin-top:2px;">
        <?= e(ucfirst($authUser['role'])) ?>
      </span>
    </div>
    <form method="POST" action="/actions/auth/logout.php" class="logout-form">
      <button type="submit" class="btn btn-outline btn-sm">Keluar</button>
    </form>
  </div>
</header>
