<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="step-finish" role="tabpanel" aria-labelledby="step-finish-tab">
<div class="container mt-4 text-center">
  <h2><?= session()->getFlashdata('success') ?? 'Registration Completed!' ?></h2>
  <?php if (!empty($coach['team_name'])): ?>
    <p>Your team: <strong><?= esc($coach['team_name']) ?></strong>
      <?php if(!empty($coach['qualifier_city'])): ?> (Qualifier: <?= esc($coach['qualifier_city']) ?>)<?php endif; ?>
      <?php if(!empty($coach['division'])): ?> - Division: <?= esc(ucfirst($coach['division'])) ?><?php endif; ?>
    </p>
  <?php endif; ?>

  <div class="mt-3 d-flex gap-2 justify-content-center">
    <a href="<?= base_url('register/coach/step1') ?>" class="btn btn-primary">
      Start Again
    </a>
  </div>
</div>
</div>
<?= $this->include('layouts/footer') ?>

