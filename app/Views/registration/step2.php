<div class="tab-pane show active" id="step2" role="tabpanel" aria-labelledby="step2-tab">
  <div class="form-frame-2">
    <?php if(!empty($error)): ?>
      <div class="alert alert-danger"><?= esc($error) ?></div>
    <?php endif; ?>

    <div class="row-2">
      <!-- LEFT SIDE IMAGE -->
      <div class="col-md-4-2">
        <img src="<?= esc($image ?? base_url('asset/step2/' . rawurlencode('Vector (2).svg'))) ?>" alt="Step 2 Illustration" class="left-image-2">
      </div>

      <!-- RIGHT SIDE FORM -->
      <div class="col-md-8-2 form-content-2">
        <h5>Coach, please complete the form below to get started:</h5>

        <form class="form-2" method="post" novalidate>
          <?= csrf_field() ?>

          <div class="row-2">
            <div class="col-2">
              <label>First Name*</label>
              <input type="text" name="first_name" value="<?= esc(session('reg.coach.first_name')) ?>" required>
            </div>
            <div class="col-2">
              <label>Middle Name</label>
              <input type="text" name="middle_name" value="<?= esc(session('reg.coach.middle_name')) ?>">
            </div>
            <div class="col-2">
              <label>Last Name*</label>
              <input type="text" name="last_name" value="<?= esc(session('reg.coach.last_name')) ?>" required>
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>Date of Birth*</label>
              <input type="date" name="dob" value="<?= esc(session('reg.coach.dob')) ?>" required>
            </div>
            <div class="col-2">
              <label>Phone Number*</label>
              <input type="tel" name="phone" value="<?= esc(session('reg.coach.phone')) ?>" required>
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>Address Line 1*</label>
              <input type="text" name="address1" value="<?= esc(session('reg.coach.address1')) ?>" required>
            </div>
            <div class="col-2">
              <label>Address Line 2</label>
              <input type="text" name="address2" value="<?= esc(session('reg.coach.address2')) ?>">
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>City*</label>
              <input type="text" name="city" value="<?= esc(session('reg.coach.city')) ?>" required>
            </div>
            <div class="col-2">
              <label>State*</label>
              <select name="state" required>
                <option value="">Select state</option>
                <option<?= session('reg.coach.state') === 'Alabama' ? ' selected' : '' ?>>Alabama</option>
                <option<?= session('reg.coach.state') === 'Alaska' ? ' selected' : '' ?>>Alaska</option>
                <option<?= session('reg.coach.state') === 'Arizona' ? ' selected' : '' ?>>Arizona</option>
                <option<?= session('reg.coach.state') === 'Arkansas' ? ' selected' : '' ?>>Arkansas</option>
                <option<?= session('reg.coach.state') === 'California' ? ' selected' : '' ?>>California</option>
              </select>
            </div>
            <div class="col-2">
              <label>ZIP / Postal Code*</label>
              <input type="text" name="zip" value="<?= esc(session('reg.coach.zip')) ?>" required>
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>E-mail*</label>
              <input type="email" name="email" value="<?= esc(session('reg.coach.email')) ?>" required>
            </div>
            <div class="col-2">
              <label>Password*</label>
              <input type="password" name="password" required>
            </div>
            <div class="col-2">
              <label>Retype Password*</label>
              <input type="password" name="password_confirm" required>
            </div>
          </div>

          <div class="activation-area-2">
            <div class="col-2">
              <label>Insert Activation Code*</label>
              <input type="text" name="activation_code" value="<?= esc(session('reg.coach.activation_code')) ?>">
            </div>
            <div>
              <p class="btn-textout-2">Activation code</p>
              <button type="button" class="btn-next-2a" id="send-code">SEND CODE</button>
              <button type="button" class="btn-next-2b" id="activate-code">ACTIVATE</button>
            </div>
          </div>

          <p class="resend-2" id="resend-timer">Resend code: 45s</p>

          <div>
            <button type="submit" class="btn-next-2c">
              <span class="btn-text-2">NEXT</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
