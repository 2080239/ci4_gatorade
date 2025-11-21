<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
  <div class="row">
    <div class="col-md-7 form-left d-flex align-items-start">
      <div class="logo-wrapper">
        <img src="<?= base_url('asset/Isolation_Mode.svg') ?>" alt="Left Side Image" class="logo-shape1">
      </div>

      <div class="form-content w-100">
        <h5 class="mb-3">Select your role to begin registration:</h5>

        <form method="post" class="needs-validation" novalidate>
          <?= csrf_field() ?>

          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="role" id="roleCoach" value="coach" checked required>
            <label class="form-check-label" for="roleCoach">Coach</label>
          </div>

          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="role" id="roleParent" value="parent" required>
            <label class="form-check-label" for="roleParent">Parent or Legal Guardian</label>
          </div>

          <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="role" id="rolePlayer" value="player" required>
            <label class="form-check-label" for="rolePlayer">Player</label>
          </div>

          <div class="mt-3 d-flex align-items-center">
            <button type="submit" class="btn btn-primary btn-next">
              <span class="btn-text">NEXT</span>
            </button>
            <a href="#" class="ms-3 rules-link align-self-center" style="position: absolute; top: 109%; left: 44%;">Gatorade 5v5 Tournament – General Rules</a>
          </div>
        </form>
      </div>
    </div>

    <div class="col-md-5 mt-3 mt-md-0">
      <div class="info-box text-center">
        <img src="<?= base_url('asset/frame 2.svg') ?>" alt="Coach Info" class="mb-3" style="max-width: 80%; margin: 45px 0;">
      </div>
    </div>
  </div>
 </div>
<?= $this->include('layouts/footer') ?>

