<?= $this->include('layouts/header') ?>
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
          <input type="hidden" name="coach_id" value="<?= esc($coachId ?? ($coach['id'] ?? '')) ?>">

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
              <input type="text" id="dob" name="dob" placeholder="YYYY-MM-DD" max="<?= date('Y-m-d', strtotime('-18 years')) ?>" value="<?= esc(session('reg.coach.dob')) ?>" required>
              <div id="dob-note" class="age-note" role="note" aria-live="polite">Must be 18 years or older</div>
            </div>
            <div class="col-2">
              <label>Phone Number*</label>
              <input type="tel" name="phone" value="<?= esc(session('reg.coach.phone')) ?>" required>
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>Address Line 1*</label>
              <input type="text" name="address_line1" value="<?= esc(session('reg.coach.address_line1')) ?>" required>
            </div>
            <div class="col-2">
              <label>Address Line 2</label>
              <input type="text" name="address_line2" value="<?= esc(session('reg.coach.address_line2')) ?>">
            </div>
          </div>

          <div class="row-2">
            <div class="col-2">
              <label>City*</label>
              <input type="text" name="city" value="<?= esc(session('reg.coach.city')) ?>" required>
            </div>
            <div class="col-2">
              <label>State*</label>
              <select name="state" id="state" class="success" required>
                <option value="">-- Select a State --</option>
                <option value="FL"<?= (session('reg.coach.state') === 'Florida' || session('reg.coach.state') === 'FL') ? ' selected' : '' ?>>Florida</option>
                <option value="AL"<?= (session('reg.coach.state') === 'Alabama' || session('reg.coach.state') === 'AL') ? ' selected' : '' ?>>Alabama</option>
                <option value="AK"<?= (session('reg.coach.state') === 'Alaska' || session('reg.coach.state') === 'AK') ? ' selected' : '' ?>>Alaska</option>
                <option value="AZ"<?= (session('reg.coach.state') === 'Arizona' || session('reg.coach.state') === 'AZ') ? ' selected' : '' ?>>Arizona</option>
                <option value="AR"<?= (session('reg.coach.state') === 'Arkansas' || session('reg.coach.state') === 'AR') ? ' selected' : '' ?>>Arkansas</option>
                <option value="CA"<?= (session('reg.coach.state') === 'California' || session('reg.coach.state') === 'CA') ? ' selected' : '' ?>>California</option>
                <option value="CO"<?= (session('reg.coach.state') === 'Colorado' || session('reg.coach.state') === 'CO') ? ' selected' : '' ?>>Colorado</option>
                <option value="CT"<?= (session('reg.coach.state') === 'Connecticut' || session('reg.coach.state') === 'CT') ? ' selected' : '' ?>>Connecticut</option>
                <option value="DE"<?= (session('reg.coach.state') === 'Delaware' || session('reg.coach.state') === 'DE') ? ' selected' : '' ?>>Delaware</option>
                <option value="GA"<?= (session('reg.coach.state') === 'Georgia' || session('reg.coach.state') === 'GA') ? ' selected' : '' ?>>Georgia</option>
                <option value="HI"<?= (session('reg.coach.state') === 'Hawaii' || session('reg.coach.state') === 'HI') ? ' selected' : '' ?>>Hawaii</option>
                <option value="ID"<?= (session('reg.coach.state') === 'Idaho' || session('reg.coach.state') === 'ID') ? ' selected' : '' ?>>Idaho</option>
                <option value="IL"<?= (session('reg.coach.state') === 'Illinois' || session('reg.coach.state') === 'IL') ? ' selected' : '' ?>>Illinois</option>
                <option value="IN"<?= (session('reg.coach.state') === 'Indiana' || session('reg.coach.state') === 'IN') ? ' selected' : '' ?>>Indiana</option>
                <option value="IA"<?= (session('reg.coach.state') === 'Iowa' || session('reg.coach.state') === 'IA') ? ' selected' : '' ?>>Iowa</option>
                <option value="KS"<?= (session('reg.coach.state') === 'Kansas' || session('reg.coach.state') === 'KS') ? ' selected' : '' ?>>Kansas</option>
                <option value="KY"<?= (session('reg.coach.state') === 'Kentucky' || session('reg.coach.state') === 'KY') ? ' selected' : '' ?>>Kentucky</option>
                <option value="LA"<?= (session('reg.coach.state') === 'Louisiana' || session('reg.coach.state') === 'LA') ? ' selected' : '' ?>>Louisiana</option>
                <option value="ME"<?= (session('reg.coach.state') === 'Maine' || session('reg.coach.state') === 'ME') ? ' selected' : '' ?>>Maine</option>
                <option value="MD"<?= (session('reg.coach.state') === 'Maryland' || session('reg.coach.state') === 'MD') ? ' selected' : '' ?>>Maryland</option>
                <option value="MA"<?= (session('reg.coach.state') === 'Massachusetts' || session('reg.coach.state') === 'MA') ? ' selected' : '' ?>>Massachusetts</option>
                <option value="MI"<?= (session('reg.coach.state') === 'Michigan' || session('reg.coach.state') === 'MI') ? ' selected' : '' ?>>Michigan</option>
                <option value="MN"<?= (session('reg.coach.state') === 'Minnesota' || session('reg.coach.state') === 'MN') ? ' selected' : '' ?>>Minnesota</option>
                <option value="MS"<?= (session('reg.coach.state') === 'Mississippi' || session('reg.coach.state') === 'MS') ? ' selected' : '' ?>>Mississippi</option>
                <option value="MO"<?= (session('reg.coach.state') === 'Missouri' || session('reg.coach.state') === 'MO') ? ' selected' : '' ?>>Missouri</option>
                <option value="MT"<?= (session('reg.coach.state') === 'Montana' || session('reg.coach.state') === 'MT') ? ' selected' : '' ?>>Montana</option>
                <option value="NE"<?= (session('reg.coach.state') === 'Nebraska' || session('reg.coach.state') === 'NE') ? ' selected' : '' ?>>Nebraska</option>
                <option value="NV"<?= (session('reg.coach.state') === 'Nevada' || session('reg.coach.state') === 'NV') ? ' selected' : '' ?>>Nevada</option>
                <option value="NH"<?= (session('reg.coach.state') === 'New Hampshire' || session('reg.coach.state') === 'NH') ? ' selected' : '' ?>>New Hampshire</option>
                <option value="NJ"<?= (session('reg.coach.state') === 'New Jersey' || session('reg.coach.state') === 'NJ') ? ' selected' : '' ?>>New Jersey</option>
                <option value="NM"<?= (session('reg.coach.state') === 'New Mexico' || session('reg.coach.state') === 'NM') ? ' selected' : '' ?>>New Mexico</option>
                <option value="NY"<?= (session('reg.coach.state') === 'New York' || session('reg.coach.state') === 'NY') ? ' selected' : '' ?>>New York</option>
                <option value="NC"<?= (session('reg.coach.state') === 'North Carolina' || session('reg.coach.state') === 'NC') ? ' selected' : '' ?>>North Carolina</option>
                <option value="ND"<?= (session('reg.coach.state') === 'North Dakota' || session('reg.coach.state') === 'ND') ? ' selected' : '' ?>>North Dakota</option>
                <option value="OH"<?= (session('reg.coach.state') === 'Ohio' || session('reg.coach.state') === 'OH') ? ' selected' : '' ?>>Ohio</option>
                <option value="OK"<?= (session('reg.coach.state') === 'Oklahoma' || session('reg.coach.state') === 'OK') ? ' selected' : '' ?>>Oklahoma</option>
                <option value="OR"<?= (session('reg.coach.state') === 'Oregon' || session('reg.coach.state') === 'OR') ? ' selected' : '' ?>>Oregon</option>
                <option value="PA"<?= (session('reg.coach.state') === 'Pennsylvania' || session('reg.coach.state') === 'PA') ? ' selected' : '' ?>>Pennsylvania</option>
                <option value="RI"<?= (session('reg.coach.state') === 'Rhode Island' || session('reg.coach.state') === 'RI') ? ' selected' : '' ?>>Rhode Island</option>
                <option value="SC"<?= (session('reg.coach.state') === 'South Carolina' || session('reg.coach.state') === 'SC') ? ' selected' : '' ?>>South Carolina</option>
                <option value="SD"<?= (session('reg.coach.state') === 'South Dakota' || session('reg.coach.state') === 'SD') ? ' selected' : '' ?>>South Dakota</option>
                <option value="TN"<?= (session('reg.coach.state') === 'Tennessee' || session('reg.coach.state') === 'TN') ? ' selected' : '' ?>>Tennessee</option>
                <option value="TX"<?= (session('reg.coach.state') === 'Texas' || session('reg.coach.state') === 'TX') ? ' selected' : '' ?>>Texas</option>
                <option value="UT"<?= (session('reg.coach.state') === 'Utah' || session('reg.coach.state') === 'UT') ? ' selected' : '' ?>>Utah</option>
                <option value="VT"<?= (session('reg.coach.state') === 'Vermont' || session('reg.coach.state') === 'VT') ? ' selected' : '' ?>>Vermont</option>
                <option value="VA"<?= (session('reg.coach.state') === 'Virginia' || session('reg.coach.state') === 'VA') ? ' selected' : '' ?>>Virginia</option>
                <option value="WA"<?= (session('reg.coach.state') === 'Washington' || session('reg.coach.state') === 'WA') ? ' selected' : '' ?>>Washington</option>
                <option value="WV"<?= (session('reg.coach.state') === 'West Virginia' || session('reg.coach.state') === 'WV') ? ' selected' : '' ?>>West Virginia</option>
                <option value="WI"<?= (session('reg.coach.state') === 'Wisconsin' || session('reg.coach.state') === 'WI') ? ' selected' : '' ?>>Wisconsin</option>
                <option value="WY"<?= (session('reg.coach.state') === 'Wyoming' || session('reg.coach.state') === 'WY') ? ' selected' : '' ?>>Wyoming</option>
              </select>
            </div>
            <div class="col-2">
              <label>ZIP / Postal Code*</label>
              <input type="text" name="zip_code" value="<?= esc(session('reg.coach.zip_code')) ?>" required>
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
              <input type="text" id="activation_code" name="activation_code" value="<?= esc(session('reg.coach.activation_code')) ?>">
            </div>
            <div>
              <p class="btn-textout-2">Activation code</p>
                <button type="button" class="btn-next-2a" id="send-code">SEND CODE</button>
                <button type="button" class="btn-next-2b" id="activate-code" disabled>ACTIVATE</button>
              </div>
              </div>

              <p class="resend-2" id="resend-timer">Resend code: 45s</p>

              <div>
              <button type="submit" id="next-btn" class="btn-next-2c" disabled>
                <span class="btn-text-2">NEXT</span>
              </button>

        <!-- Flatpickr (custom calendar with footer note) -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>

        <script>
        (function(){
          const sendBtn = document.getElementById('send-code');
          const activateBtn = document.getElementById('activate-code');
          const nextBtn = document.getElementById('next-btn');
          const codeInput = document.getElementById('activation_code');
          const dobInput = document.getElementById('dob');
          const dobNote = document.getElementById('dob-note');
          const formEl = document.querySelector('form.form-2');

          function setState(stage){
            switch(stage){
              case 'initial':
                sendBtn.disabled = false;
                activateBtn.disabled = true;
                nextBtn.disabled = true;
                codeInput.disabled = false;
                sendBtn.textContent = 'SEND CODE';
                activateBtn.textContent = 'ACTIVATE';
                // NEXT stays 'NEXT'
                break;
              case 'codeSent':
                sendBtn.disabled = true;
                activateBtn.disabled = false; // allow user to click and validate input
                nextBtn.disabled = true;
                codeInput.disabled = false;
                sendBtn.textContent = 'CODE SENT \u2713';
                activateBtn.textContent = 'ACTIVATE';
                break;
              case 'activated':
                sendBtn.disabled = true;
                activateBtn.disabled = true;
                nextBtn.disabled = false;
                codeInput.disabled = true;
                sendBtn.textContent = 'CODE SENT \u2713';
                activateBtn.textContent = 'ACTIVATED';
                break;
            }
          }

          // Init state
          setState('initial');

          // Initialize Flatpickr on DOB with 18+ restriction and footer note
          if (window.flatpickr && dobInput) {
            const maxDate = (function(){
              const d = new Date();
              d.setFullYear(d.getFullYear() - 18);
              return d;
            })();

            function addFooter(instance){
              const cal = instance && instance.calendarContainer;
              if (!cal) return;
              if (!cal.querySelector('.age-footnote')){
                const foot = document.createElement('div');
                foot.className = 'age-footnote';
                foot.textContent = 'Must be 18 years or older';
                cal.appendChild(foot);
              }
            }

            flatpickr(dobInput, {
              dateFormat: 'Y-m-d',
              maxDate: maxDate,
              disableMobile: true,
              onReady: addFooter,
              onOpen: addFooter
            });
          }

          // DOB validation: must be >= 18 years old
          function validateDob(){
            if (!dobInput) return true;
            const val = dobInput.value;
            if (!val) { dobInput.setCustomValidity(''); dobNote && dobNote.classList.remove('error'); return true; }
            const picked = new Date(val);
            const minAge = new Date();
            minAge.setFullYear(minAge.getFullYear() - 18);
            const ok = picked <= minAge;
            if (!ok){
              dobInput.setCustomValidity('Must be 18 years or older');
              dobNote && dobNote.classList.add('error');
            } else {
              dobInput.setCustomValidity('');
              dobNote && dobNote.classList.remove('error');
            }
            return ok;
          }
          dobInput && dobInput.addEventListener('change', validateDob);
          dobInput && dobInput.addEventListener('input', validateDob);

          // Simple required field validation before sending code
          function validateRequiredForSend(){
            const requiredSelectors = [
              'input[name="first_name"]',
              'input[name="last_name"]',
              'input[name="dob"]',
              'input[name="phone"]',
              'input[name="address_line1"]',
              'input[name="city"]',
              'select[name="state"]',
              'input[name="zip_code"]',
              'input[name="email"]',
              'input[name="password"]',
              'input[name="password_confirm"]'
            ];
            const missing = [];
            requiredSelectors.forEach(sel => {
              const el = formEl.querySelector(sel);
              if(!el) return;
              const val = (el.value || '').trim();
              // For dob use validateDob too
              if(el === dobInput){
                validateDob();
                if(!val || !dobInput.checkValidity()) missing.push('Date of Birth');
              } else if(val === '') {
                missing.push(el.previousElementSibling && el.previousElementSibling.tagName === 'LABEL'
                  ? el.previousElementSibling.textContent.replace('*','').trim()
                  : sel);
              }
            });
            // Basic password match check (optional quality improvement)
            const pw = formEl.querySelector('input[name="password"]');
            const pwc = formEl.querySelector('input[name="password_confirm"]');
            if(pw && pwc && pw.value && pwc.value && pw.value !== pwc.value){
              missing.push('Password (must match)');
              pwc.setCustomValidity('Passwords must match');
            } else if(pwc){
              pwc.setCustomValidity('');
            }
            // Highlight missing
            requiredSelectors.forEach(sel => {
              const el = formEl.querySelector(sel);
              if(!el) return;
              el.style.borderColor = '#ccc';
            });
            if(missing.length){
              requiredSelectors.forEach(sel => {
                const el = formEl.querySelector(sel);
                if(!el) return;
                const labelText = (el.previousElementSibling && el.previousElementSibling.tagName === 'LABEL') ? el.previousElementSibling.textContent.replace('*','').trim() : '';
                if(missing.some(m => labelText && m.startsWith(labelText))) {
                  el.style.borderColor = '#d9534f';
                }
              });
              alert('Please fill required fields before sending code:\n- ' + missing.join('\n- '));
              return false;
            }
            return true;
          }

          // Enable ACTIVATE when user types (only after codeSent stage)
          codeInput.addEventListener('input', () => {
            // Only affect button while in 'codeSent' stage (sendBtn is disabled)
            if (sendBtn.disabled && !nextBtn.disabled) return; // already activated
            if (sendBtn.disabled) {
              activateBtn.disabled = !codeInput.value.trim() ? false : false; // keep enabled; input will be validated server-side
            }
          });

          // Intercept SEND CODE to validate form first
          sendBtn.addEventListener('click', function(e){
            if(sendBtn.disabled) return;
            if(!validateRequiredForSend()){
              // Stop default send logic; prevent second listener (in lower script) from firing by setting a flag
              sendBtn.dataset.blockSend = '1';
            } else {
              sendBtn.dataset.blockSend = '0';
            }
          }, true); // capture so it runs before other click handler

          // Expose state function globally if needed later
          window.__activationSetState = setState;
        })();
        </script>
          </div>
        </form>
        <script>
        (function(){
          const sendBtn = document.getElementById('send-code');
          const activateBtn = document.getElementById('activate-code');
          const nextBtn = document.getElementById('next-btn');
          const codeInput = document.getElementById('activation_code');
          const coachIdInput = document.querySelector('input[name="coach_id"]');
          const csrfName = '<?= csrf_token() ?>';
          const csrfValue = '<?= csrf_hash() ?>';
          const timerEl = document.getElementById('resend-timer');
          let resendSeconds = 45;
          let resendInterval;

          function startTimer(){
            clearInterval(resendInterval);
            resendSeconds = 45;
            timerEl.textContent = 'Resend code: ' + resendSeconds + 's';
            resendInterval = setInterval(()=>{
              resendSeconds--;
              if(resendSeconds <= 0){
                clearInterval(resendInterval);
                timerEl.textContent = 'You can resend now';
                // Allow resend ONLY if not activated yet
                if(nextBtn.disabled) sendBtn.disabled = false;
              } else {
                timerEl.textContent = 'Resend code: ' + resendSeconds + 's';
              }
            },1000);
          }

          function post(url, data){
            return fetch(url, {
              method: 'POST',
              headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
              body: new URLSearchParams(Object.assign(data, { [csrfName]: csrfValue }))
            }).then(r=>r.json());
          }

          sendBtn.addEventListener('click', function(){
            if (sendBtn.disabled) return;
            if(sendBtn.dataset.blockSend === '1'){ return; }
            sendBtn.disabled = true;
            post('<?= site_url('/register/coach/send-code') ?>', { coach_id: coachIdInput.value })
              .then(resp => {
                if(resp.ok){
                  codeInput.value = resp.code || codeInput.value;
                  window.__activationSetState && window.__activationSetState('codeSent');
                  alert('Activation code sent.');
                  startTimer();
                } else {
                  alert(resp.error || 'Failed to send code');
                  window.__activationSetState && window.__activationSetState('initial');
                }
              })
              .catch(()=>{ alert('Network error'); window.__activationSetState && window.__activationSetState('initial'); });
          });

          activateBtn.addEventListener('click', function(){
            if (activateBtn.disabled) return;
            activateBtn.disabled = true;
            post('<?= site_url('/register/coach/activate-code') ?>', { coach_id: coachIdInput.value, activation_code: codeInput.value })
              .then(resp => {
                if(resp.ok){
                  alert('Code verified.');
                  window.__activationSetState && window.__activationSetState('activated');
                } else {
                  alert(resp.error || 'Invalid code');
                  window.__activationSetState && window.__activationSetState('codeSent');
                }
              })
              .catch(()=>{ alert('Network error'); window.__activationSetState && window.__activationSetState('codeSent'); });
          });
        })();
        </script>
      </div>
    </div>
  </div>
 </div>
<?= $this->include('layouts/footer') ?>
