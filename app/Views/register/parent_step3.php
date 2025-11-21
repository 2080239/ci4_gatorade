<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="parent-step3" role="tabpanel">
  <h5>Athlete Information Review</h5>
  <form method="post" novalidate>
    <?= csrf_field() ?>
    <input type="hidden" name="parent_id" value="<?= esc($parent['id']) ?>">
    <?php if($athlete): ?>
      <input type="hidden" name="athlete_id" value="<?= esc($athlete['id']) ?>">
      <div class="row g-3">
        <div class="col-md-4">
          <label>Athlete First Name</label>
          <input type="text" name="athlete_first_name" value="<?= esc($athlete['first_name']) ?>" class="form-control">
        </div>
        <div class="col-md-4">
          <label>Athlete Last Name</label>
          <input type="text" name="athlete_last_name" value="<?= esc($athlete['last_name']) ?>" class="form-control">
        </div>
        <div class="col-md-4">
          <label>Athlete DOB</label>
          <input type="date" name="athlete_dob" value="<?= esc($athlete['dob']) ?>" class="form-control">
        </div>
      </div>
    <?php else: ?>
      <p>No linked athlete record found.</p>
    <?php endif; ?>
    <div class="mt-4">
      <button type="submit" class="btn btn-primary">NEXT STEP</button>
    </div>
  </form>
</div>
<?= $this->include('layouts/footer') ?>