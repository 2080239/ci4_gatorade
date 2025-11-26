<?= $this->include('layouts/header') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<?php // /C:/wamp64/www/ci4_gatorade/app/Views/registration/step3.php ?>
<div class="tab-pane show active" id="step3" role="tabpanel" aria-labelledby="step3-tab">
  <form method="post" id="rosterForm">
    <?= csrf_field() ?>
    <input type="hidden" name="coach_id" value="<?= esc($coach['id'] ?? ($coachId ?? '')) ?>">
    <input type="hidden" id="roster_json" name="roster_json" value="">
    <input type="hidden" name="save_exit" id="save_exit" value="0">

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
            <input type="text" name="team_name" value="<?= esc($coach['team_name'] ?? '') ?>" required>
          </div>

          <div class="step3-col">
            <label>Regional Qualifier City</label>
            <?php $qc = $coach['qualifier_city'] ?? ''; ?>
            <select name="qualifier_city">
              <option value="">Select city</option>
              <option value="Los Angeles" <?= ($qc=='Los Angeles')? 'selected' : '' ?>>Los Angeles</option>
              <option value="Chicago" <?= ($qc=='Chicago')? 'selected' : '' ?>>Chicago</option>
              <option value="New York" <?= ($qc=='New York')? 'selected' : '' ?>>New York</option>
            </select>
          </div>

          <div class="step3-col">
            <label>Select Your Division</label>
            <?php $div = $coach['division'] ?? ''; ?>
            <div style="display:flex;gap:18px;align-items:center;">
              <label style="margin-bottom:0;">
                <input type="radio" name="division" value="boys" <?= ($div=='boys')? 'checked' : '' ?>> Boys
              </label>
              <label style="margin-bottom:0;">
                <input type="radio" name="division" value="girls" <?= ($div=='girls')? 'checked' : '' ?>> Girls
              </label>
            </div>
          </div>
        </div>

        <div class="step3-section-title">Team Roster</div>

        <?php $existing = $rosterExisting ?? []; ?>
        <?php for ($i = 0; $i < 8; $i++): ?>
          <?php
            $row = $existing[$i] ?? [];
            $first = esc($row['athlete_first'] ?? '');
            $middle = esc($row['athlete_middle'] ?? '');
            $last = esc($row['athlete_last'] ?? '');
            $dob = esc($row['athlete_dob'] ?? '');
            $phone = esc($row['athlete_phone'] ?? '');
            $email = esc($row['athlete_email'] ?? '');
            $gfirst = esc($row['parent_first'] ?? '');
            $gemail = esc($row['parent_email'] ?? '');
            $gphone = esc($row['parent_phone'] ?? '');
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
                  <label>Date of Birth<?= $i < 6 ? '*' : '' ?></label>
                  <input class="athlete-dob" type="text" name="athlete_dob[]" value="<?= $dob ?>" <?= ($i < 6) ? 'required' : '' ?> placeholder="YYYY-MM-DD">
                </div>
                <div class="step3-col">
                  <label>Phone Number<?= $i < 6 ? '*' : '' ?></label>
                  <input type="tel" name="athlete_phone[]" value="<?= $phone ?>" <?= ($i < 6) ? 'required' : '' ?>>
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
          <button type="button" class="step3-btn step3-btn-grey" onclick="(function(){ const f=document.getElementById('rosterForm'); document.getElementById('save_exit').value='1'; if(typeof f.requestSubmit==='function'){ f.requestSubmit(); } else { const btn=f.querySelector('button[type=\'submit\']'); if(btn){ btn.click(); } else { f.submit(); } } })();"><span>SAVE AND EXIT</span></button>
          <button type="submit" class="step3-btn step3-btn-orange"><span>NEXT</span></button>
        </div>
      </div>
    </div>
  </form>
 </div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
(function(){
  const form = document.getElementById('rosterForm');
  const rosterField = document.getElementById('roster_json');
  const minDate = new Date('2009-05-31');
  const maxDate = new Date('2011-11-01');
  document.querySelectorAll('.athlete-dob').forEach(function(inp){
    flatpickr(inp, {
      dateFormat:'Y-m-d',
      allowInput:true,
      clickOpens:true,
      minDate:minDate,
      maxDate:maxDate,
      disableMobile:true,
      onReady:function(sel,dateStr,inst){
        const cal = inst.calendarContainer;
        if(!cal.querySelector('.age-footnote')){
          const note = document.createElement('div');
          note.className='age-footnote';
          note.style.cssText='padding:6px 8px;background:#fff3e0;border-top:1px solid #ffc085;font-size:11px;color:#d35400;';
          note.innerHTML='<strong>Age Requirements:</strong><br>14+ on Nov 1, 2025<br>Under 17 on May 30, 2026';
          cal.appendChild(note);
        }
      }
    });
  });
  form.addEventListener('submit', function(){
    const first = document.querySelectorAll('input[name="athlete_first_name[]"]');
    const middle = document.querySelectorAll('input[name="athlete_middle_name[]"]');
    const last = document.querySelectorAll('input[name="athlete_last_name[]"]');
    const dob = document.querySelectorAll('input[name="athlete_dob[]"]');
    const phone = document.querySelectorAll('input[name="athlete_phone[]"]');
    const email = document.querySelectorAll('input[name="athlete_email[]"]');
    const pfirst = document.querySelectorAll('input[name="parent_name[]"]');
    const pemail = document.querySelectorAll('input[name="parent_email[]"]');
    const pphone = document.querySelectorAll('input[name="parent_phone[]"]');
    const roster = [];
    for (let i=0;i<first.length;i++) {
      const af = first[i].value.trim();
      const al = last[i].value.trim();
      const ae = email[i].value.trim();
      if (!af && !al && !ae) continue;
      const dobVal = dob[i].value || null;
      let dobOk = true;
      if(dobVal){
        const ts = Date.parse(dobVal);
        if(isNaN(ts) || ts < minDate.getTime() || ts > maxDate.getTime()) dobOk = false;
      }
      roster.push({
        athlete_first: af || null,
        athlete_middle: middle[i].value.trim() || null,
        athlete_last: al || null,
        athlete_email: ae || null,
        athlete_dob: dobOk ? dobVal : null,
        athlete_phone: phone[i].value.trim() || null,
        parent_first: pfirst[i].value.trim() || null,
        parent_email: pemail[i].value.trim() || null,
        parent_phone: pphone[i].value.trim() || null,
        is_reserve: i >= 6 ? 1 : 0
      });
    }
    rosterField.value = JSON.stringify(roster);
  });
})();
</script>
<?= $this->include('layouts/footer') ?>
