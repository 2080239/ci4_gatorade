<?= $this->include('layouts/header') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<div class="tab-pane show active" id="athlete-step2" role="tabpanel">
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
        <h6>Welcome, <span style="color:#ff5722;"><?= esc(trim(($athlete['first_name'] ?? '') . ' ' . ($athlete['last_name'] ?? ''))) ?></span>
Please review and complete your athlete information below.
Ensure all details are accurate and update any incorrect information.</h6>

        <form class="form-2" method="post" novalidate>
          <?= csrf_field() ?>
          <input type="hidden" name="athlete_id" value="<?= esc($athlete['id']) ?>">

          <div class="row-2">
            <div class="col-2">
              <label>First Name*</label>
              <input type="text" name="first_name" value="<?= esc($athlete['first_name']) ?>" required>
            </div>
            <div class="col-2">
              <label>Middle Name</label>
              <input type="text" name="middle_name" value="<?= esc($athlete['middle_name']) ?>">
            </div>
            <div class="col-2">
              <label>Last Name*</label>
              <input type="text" name="last_name" value="<?= esc($athlete['last_name']) ?>" required>
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>Date of Birth* <small id="ageRange" style="display:block;font-weight:normal;color:#ff5722;"></small></label>
              <input id="athleteDob" type="text" name="dob" value="<?= esc($athlete['dob']) ?>" required>
            </div>
            <div class="col-2">
              <label>Phone Number</label>
              <input type="tel" name="phone" value="<?= esc($athlete['phone']) ?>">
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>Address Line 1*</label>
              <input type="text" name="address_line1" value="<?= esc($athlete['address_line1']) ?>" required>
            </div>
            <div class="col-2">
              <label>Address Line 2</label>
              <input type="text" name="address_line2" value="<?= esc($athlete['address_line2']) ?>">
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>City*</label>
              <input type="text" name="city" value="<?= esc($athlete['city']) ?>" required>
            </div>
            <div class="col-2">
              <label>State*</label>
              <select name="state" required>
                <?php $st = $athlete['state'] ?? ''; ?>
                <option value="">Select state</option>
                <?php
                  $states = [
                    'Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','Florida','Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington','West Virginia','Wisconsin','Wyoming'
                  ];
                  foreach($states as $state):
                ?>
                  <option value="<?= esc($state) ?>"<?= $st===$state ? ' selected' : '' ?>><?= esc($state) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-2">
              <label>ZIP / Postal Code*</label>
              <input type="text" name="zip_code" value="<?= esc($athlete['zip_code']) ?>" required>
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>E-mail*</label>
              <input type="email" name="email" value="<?= esc($athlete['email']) ?>" required>
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

          <div>
            <button type="submit" class="btn-next-2c" style="background-color:#ff5722; border: none;">
              <span class="btn-text-2" style="color:#fff;">NEXT</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
 </div>
<?= $this->include('layouts/footer') ?>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
 (function(){
   const dobInput = document.getElementById('athleteDob');
   if(!dobInput) return;
   // Age rule: 14+ on Nov 1 2025 AND under 17 on May 30 2026
   const minDate = new Date('2009-05-31'); // > May 30 2009
   const maxDate = new Date('2011-11-01'); // <= Nov 1 2011
   const rangeText = 'Allowed DOB: May 31, 2009 to Nov 1, 2011';
   document.getElementById('ageRange').textContent = rangeText;
   flatpickr(dobInput, {
     dateFormat: 'Y-m-d',
     allowInput: true,
     maxDate: maxDate,
     minDate: minDate,
     disableMobile: true,
     onReady: function(selectedDates, dateStr, instance){
       const fpCal = instance.calendarContainer;
       if(!fpCal.querySelector('.age-footnote')){
         const note = document.createElement('div');
         note.className = 'age-footnote';
         note.style.cssText = 'padding:8px 10px;background:#fff3e0;border-top:1px solid #ffc085;font-size:12px;color:#d35400;';
         note.innerHTML = '<strong>Age Requirements:</strong><br>14+ on Nov 1, 2025<br>Under 17 on May 30, 2026';
         fpCal.appendChild(note);
       }
     }
   });
 })();
</script>