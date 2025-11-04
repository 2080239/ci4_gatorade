<?php // /C:/wamp64/www/ci4_gatorade/app/Views/registration/step3.php ?>
<div class="tab-pane show active" id="step3" role="tabpanel" aria-labelledby="step3-tab">
  <form method="post">
    <?= csrf_field() ?>

    <div class="step3-row">
      <!-- LEFT IMAGE -->
      <div class="step3-col-md-4">
        <img src="<?= base_url('asset/step2/step3.svg') ?>" alt="Step 3 Illustration" class="left-image" style="margin:122px 0 0 42px;width:54%;">
      </div>

      <!-- FORM CONTENT -->
      <div class="step3-col-md-8 step3-form-content">
        <h2>Great job, <span>Coach John!</span> Now let's add your team members:</h2>
        <p class="sub">If you don't have the full roster yet, you can update it later in your team dashboard.</p>

        <div class="step3-section-title">Team Information</div>
        <div class="step3-row-fields">
          <div class="step3-col">
            <label>Team Name*</label>
            <input type="text" name="team_name" value="<?= esc(session('reg.team.team_name')) ?>" required>
          </div>

          <div class="step3-col">
            <label>Regional Qualifier City</label>
            <select name="qualifier_city">
              <?php $qc = session('reg.team.qualifier_city'); ?>
              <option value="">Select city</option>
              <option value="Los Angeles" <?= ($qc=='Los Angeles')? 'selected' : '' ?>>Los Angeles</option>
              <option value="Chicago" <?= ($qc=='Chicago')? 'selected' : '' ?>>Chicago</option>
              <option value="New York" <?= ($qc=='New York')? 'selected' : '' ?>>New York</option>
            </select>
          </div>

          <div class="step3-col">
            <label>Select Your Division</label>
            <div style="display:flex;gap:18px;align-items:center;">
              <label style="margin-bottom:0;">
                <input type="radio" name="division" value="boys" <?= (session('reg.team.division')=='boys')? 'checked' : '' ?>> Boys
              </label>
              <label style="margin-bottom:0;">
                <input type="radio" name="division" value="girls" <?= (session('reg.team.division')=='girls')? 'checked' : '' ?>> Girls
              </label>
            </div>
          </div>
        </div>

        <div class="step3-section-title">Team Roster</div>

        <?php for ($i = 0; $i < 8; $i++): ?>
          <?php
            // Use session stored athletes if available
            $idx = $i;
            $first = esc(session("reg.athletes.$idx.first_name"));
            $middle = esc(session("reg.athletes.$idx.middle_name"));
            $last = esc(session("reg.athletes.$idx.last_name"));
            $dob = esc(session("reg.athletes.$idx.dob"));
            $phone = esc(session("reg.athletes.$idx.phone"));
            $email = esc(session("reg.athletes.$idx.email"));
            $gfirst = esc(session("reg.athletes.$idx.parent_name") ?? session("reg.athletes.$idx.guardian_first"));
            $gemail = esc(session("reg.athletes.$idx.parent_email") ?? session("reg.athletes.$idx.guardian_email"));
            $gphone = esc(session("reg.athletes.$idx.parent_phone") ?? session("reg.athletes.$idx.guardian_phone"));
          ?>
          <div class="step3-athlete-block">
            <div class="step3-athlete-number"><img src="<?= base_url("asset/step2/".($i+1).".svg") ?>" alt="<?= $i+1 ?>"></div>
            <div class="step3-athlete-fields">
              <label class="step3-athlete">Athlete</label>

              <div class="step3-row-fields">
                <div class="step3-col">
                  <label>First Name<?= $i < 6 ? '*' : '' ?></label>
                  <input type="text" name="athlete_first_name[]" value="<?= $first ?>" <?= ($i < 6) ? 'required' : '' ?>>
                </div>
                <div class="step3-col">
                  <label>Middle Name</label>
                  <input type="text" name="athlete_middle_name[]" value="<?= $middle ?>">
                </div>
                <div class="step3-col">
                  <label>Last Name<?= $i < 6 ? '*' : '' ?></label>
                  <input type="text" name="athlete_last_name[]" value="<?= $last ?>" <?= ($i < 6) ? 'required' : '' ?>>
                </div>
              </div>

              <div class="step3-row-fields">
                <div class="step3-col">
                  <label>Date of Birth</label>
                  <input type="date" name="athlete_dob[]" value="<?= $dob ?>">
                </div>
                <div class="step3-col">
                  <label>Phone Number</label>
                  <input type="tel" name="athlete_phone[]" value="<?= $phone ?>">
                </div>
                <div class="step3-col">
                  <label>E-mail<?= $i < 6 ? '*' : '' ?></label>
                  <input type="email" name="athlete_email[]" value="<?= $email ?>" <?= ($i < 6) ? 'required' : '' ?>>
                </div>
              </div>

              <div class="step3-row-fields">
               <div class="step3-col">
                  <label>Parent/Guardian First Name<?= $i < 6 ? '*' : '' ?></label>
                  <input type="text" name="parent_name[]" value="<?= $gfirst ?>" <?= ($i < 6) ? 'required' : '' ?>>
                </div>
                <div class="step3-col">
                  <label>E-mail<?= $i < 6 ? '*' : '' ?></label>
                  <input type="email" name="parent_email[]" value="<?= $gemail ?>" <?= ($i < 6) ? 'required' : '' ?>>
                </div>
                <div class="step3-col">
                  <label>Phone Number</label>
                  <input type="tel" name="parent_phone[]" value="<?= $gphone ?>">
                </div>
              </div>
            </div>
          </div>
        <?php endfor; ?>

        <div class="step3-section-title">Reserve Athletes</div>
        <p class="step3-reserve-note">You may list up to 2 additional athletes who are not part of your official roster. These athletes can only step in if a rostered player is unable to participate on tournament day.</p>

        <!-- Buttons -->
        <div class="step3-form-buttons">
          <button type="button" class="step3-btn step3-btn-light" onclick="previousStep(3)"><span>PREVIOUS</span></button>
          <button type="button" class="step3-btn step3-btn-grey" onclick="window.location='<?= site_url('dashboard') ?>'"><span>SAVE AND EXIT</span></button>
          <button type="submit" class="step3-btn step3-btn-orange"><span>NEXT</span></button>
        </div>
      </div>
    </div>
  </form>
</div>
