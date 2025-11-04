<div class="container mt-4 text-center">
  <h2><?= session()->getFlashdata('success') ?? 'Registration Completed!' ?></h2>
  <div class="mt-3 d-flex gap-2 justify-content-center">
    <a href="<?= base_url('register/step1') ?>" class="btn btn-primary">Start Again</a>
    <a href="<?= base_url('register/all') ?>" class="btn btn-outline-secondary">View All Records</a>
  </div>
</div>
