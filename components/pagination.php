<?php
// Butuh variabel $pagination dari paginate().
$page = $pagination['page'];
$totalPages = $pagination['total_pages'];
?>
<div class="pagination-wrap">
  <p class="pagination-info">
    Menampilkan <?= $pagination['from'] ?>&ndash;<?= $pagination['to'] ?> dari <?= $pagination['total'] ?> data
  </p>

  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="<?= e(pageUrl($page - 1)) ?>" class="pagination-btn" aria-label="Halaman sebelumnya">&lt;</a>
    <?php else: ?>
      <span class="pagination-btn is-disabled">&lt;</span>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
      <a href="<?= e(pageUrl($i)) ?>" class="pagination-btn <?= $i === $page ? 'is-active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
      <a href="<?= e(pageUrl($page + 1)) ?>" class="pagination-btn" aria-label="Halaman berikutnya">&gt;</a>
    <?php else: ?>
      <span class="pagination-btn is-disabled">&gt;</span>
    <?php endif; ?>
  </div>
</div>
