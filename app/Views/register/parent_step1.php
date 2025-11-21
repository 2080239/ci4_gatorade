<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="parent-step1" role="tabpanel">
  <div class="row">
    <div class="col-md-11 form-left d-flex align-items-start">
      <div class="logo-wrapper">
        <img src="<?= base_url('asset/Isolation_Mode.svg') ?>" alt="Left Side Image" class="logo-shape1">
      </div>

      <div class="form-content w-100">
        <h6 class="mb-3">Hello, to continue your child’s registration as a parent or legal guardian, please enter your e‑mail address and the invitation code sent by the coach.</h6>

        <?php if(!empty($error)): ?><div class="alert alert-danger"><?= esc($error) ?></div><?php endif; ?>

        <form method="post" class="needs-validation" novalidate>
          <?= csrf_field() ?>

          <div class="mb-3">
            <label for="parentEmail">E-mail*</label>
            <input id="parentEmail" type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="parentInviteCode">Invitation Code*</label>
            <input id="parentInviteCode" type="text" name="invitation_code" class="form-control" required>
          </div>

          <div class="mt-3 d-flex align-items-center">
            <button type="submit" class="btn btn-primary btn-next">
              <span class="btn-text">NEXT</span>
            </button>
            <a href="#" class="ms-3 rules-link align-self-center" style="position:absolute; top:109%; left:45%;">Gatorade 5v5 Tournament – General Rules</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?= $this->include('layouts/footer') ?>