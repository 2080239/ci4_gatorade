<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="parent-finish" role="tabpanel">
  <div class="text-center mt-5">
    <h3>Parent Registration Complete</h3>
    <p>Thank you <?= esc($parent['first_name'] ?? '') ?>. Your information has been saved.</p>
    <a href="<?= site_url('register/parent/step1') ?>" class="btn btn-primary">Start Another</a>
  </div>
</div>
<?= $this->include('layouts/footer') ?>