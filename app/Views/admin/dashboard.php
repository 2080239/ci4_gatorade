<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="admin-dashboard" role="tabpanel">
  <div class="container py-4">
    <h3 class="mb-3">Admin Dashboard</h3>
    <p class="text-muted">Welcome, Admin. Here are quick stats:</p>
    <div class="row g-3">
      <div class="col-md-4"><div class="alert alert-secondary">Coaches: <strong><?= esc($coachCount) ?></strong></div></div>
      <div class="col-md-4"><div class="alert alert-secondary">Parents: <strong><?= esc($parentCount) ?></strong></div></div>
      <div class="col-md-4"><div class="alert alert-secondary">Athletes: <strong><?= esc($athleteCount) ?></strong></div></div>
    </div>
    <div class="mt-3">
      <a class="btn btn-sm btn-outline-dark" href="<?= site_url('/logout') ?>">Logout</a>
    </div>
  </div>
</div>
<?= $this->include('layouts/footer') ?>
