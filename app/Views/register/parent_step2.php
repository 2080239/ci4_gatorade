<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="parent-step2" role="tabpanel">
  <div class="form-frame-2">
    <?php if(!empty($error)): ?><div class="alert alert-danger"><?= esc($error) ?></div><?php endif; ?>

    <!-- <div class="steps-wrapper">
      <div class="step"><div class="step-inner">STEP 1</div></div>
      <div class="step active"><div class="step-inner">STEP 2</div></div>
      <div class="step"><div class="step-inner">STEP 3</div></div>
      <div class="step"><div class="step-inner">STEP 4</div></div>
    </div> -->

    <div class="row-2">
      <!-- LEFT SIDE IMAGE -->
      <div class="col-md-4-2">
        <img src="<?= esc($image ?? base_url('asset/step2/' . rawurlencode('Vector (2).svg'))) ?>" alt="Parent Step 2 Illustration" class="left-image-2">
      </div>

      <!-- RIGHT SIDE FORM -->
      <div class="col-md-8-2 form-content-2">
        <h6>Welcome, <span style="color:#ff5722;"><?= esc(trim(($parent['first_name'] ?? '') . ' ' . ($parent['last_name'] ?? ''))) ?></span>
Please review and complete your Parent / Legal Guardian information below. Ensure all details are accurate and update any incorrect information before proceeding.</h6>

        <form class="form-2" method="post" novalidate>
          <?= csrf_field() ?>
          <input type="hidden" name="parent_id" value="<?= esc($parent['id']) ?>">

          <div class="row-2">
            <div class="col-2">
              <label>First Name*</label>
              <input type="text" name="first_name" value="<?= esc($parent['first_name']) ?>" required>
            </div>
            <div class="col-2">
              <label>Middle Name</label>
              <input type="text" name="middle_name" value="<?= esc($parent['middle_name']) ?>">
            </div>
            <div class="col-2">
              <label>Last Name*</label>
              <input type="text" name="last_name" value="<?= esc($parent['last_name']) ?>" required>
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>Date of Birth*</label>
              <input type="date" name="dob" value="<?= esc($parent['dob']) ?>" required>
            </div>
            <div class="col-2">
              <label>Phone Number</label>
              <input type="tel" name="phone" value="<?= esc($parent['phone']) ?>">
            </div>
            <div class="col-2">
              <label>E-mail*</label>
              <input type="email" name="email" value="<?= esc($parent['email']) ?>" required>
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>Address Line 1</label>
              <input type="text" name="address_line1" value="<?= esc($parent['address_line1']) ?>">
            </div>
            <div class="col-2">
              <label>Address Line 2</label>
              <input type="text" name="address_line2" value="<?= esc($parent['address_line2']) ?>">
            </div>
            <div class="col-2">
              <label>City</label>
              <input type="text" name="city" value="<?= esc($parent['city']) ?>">
            </div>
          </div>

            <div class="row-2">
              <div class="col-2">
                <label>State</label>
                <select name="state">
                  <?php $st = $parent['state'] ?? ''; ?>
                  <option value="">Select state</option>
                  <option<?= $st==='Alabama' ? ' selected' : '' ?>>Alabama</option>
                  <option<?= $st==='Alaska' ? ' selected' : '' ?>>Alaska</option>
                  <option<?= $st==='Arizona' ? ' selected' : '' ?>>Arizona</option>
                  <option<?= $st==='Arkansas' ? ' selected' : '' ?>>Arkansas</option>
                  <option<?= $st==='California' ? ' selected' : '' ?>>California</option>
                </select>
              </div>
              <div class="col-2">
                <label>ZIP / Postal Code</label>
                <input type="text" name="zip_code" value="<?= esc($parent['zip_code']) ?>">
              </div>
              <div class="col-2">
                <label>Password*</label>
                <input type="password" name="password" required>
              </div>
            </div>

            <div class="row-2">
              <div class="col-2">
                <label>Retype Password*</label>
                <input type="password" name="password_confirm" required>
              </div>
            </div>

          <div>
            <button type="submit" class="btn-next-2c" style="background-color:#ff5722; border: none;">
              <span class="btn-text-2" style="color:#fff;">NEXT</span>
            </button>
          </div>
        </form>
      </div>
    </div>
    <div style="text-align:center; margin-top:28px;">
      <a href="#" class="rules-link" style="color:#ef5a22; font-size:13px; font-weight:600; text-decoration:underline;">Gatorade 5v5 Tournament – General Rules</a>
    </div>
  </div>
 </div>
<?= $this->include('layouts/footer') ?>