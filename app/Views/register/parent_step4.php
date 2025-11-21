<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="parent-step4" role="tabpanel">
  <h5>Upload Document & Consents</h5>
  <form method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="parent_id" value="<?= esc($parent['id']) ?>">
    <div class="mb-3">
      <label>Parent Passport / Photo</label>
      <input type="file" name="parent_doc" class="form-control">
    </div>
    <div class="mb-3">
      <label><input type="checkbox" name="consent_waiver" required> Tournament Waiver*</label>
    </div>
    <div class="mb-3">
      <label><input type="checkbox" name="consent_code" required> Code of Conduct*</label>
    </div>
    <div class="mb-3">
      <label><input type="checkbox" name="marketing_email"> Marketing Emails</label>
    </div>
    <div class="mb-3">
      <label><input type="checkbox" name="marketing_sms"> Marketing SMS</label>
    </div>
    <button type="submit" class="btn btn-success">FINISH</button>
  </form>
</div>
<?= $this->include('layouts/footer') ?>