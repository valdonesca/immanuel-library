<?php $flash = getFlash(); ?>
<?php if ($flash): ?>
  <div class="alert alert-<?= e($flash['type']) ?>" role="alert">
    <?= e($flash['message']) ?>
  </div>
<?php endif; ?>
