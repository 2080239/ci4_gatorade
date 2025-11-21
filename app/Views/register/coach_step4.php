<?= $this->include('layouts/header', ['currentStep' => 4, 'title' => 'Register – Step 4']) ?>
<form method="post" action="<?= site_url('/register/coach/step4') ?>" enctype="multipart/form-data" class="tab-pane show active" id="step4" role="tabpanel" aria-labelledby="step4-tab">
  <?= csrf_field() ?>
  <input type="hidden" name="coach_id" value="<?= esc($coach['id'] ?? ($coachId ?? '')) ?>">

  <div class="form-step4-frame">
    <div class="container">
      <div class="row">
        <div class="col-2">
          <div class="form-step4-number">
            <img src="<?= base_url('asset/step2/step4.svg') ?>" alt="Step 4 badge showing the number 4 centered inside an orange circular progress icon representing the fourth registration step; white background; contains text Step 4; tone informative and encouraging">
          </div>
        </div>

        <div class="col-10">
          <div class="form-step4-container">
            <h5>Athlete’s documentation upload:</h5>

            <div class="form-step4-upload">
              <div class="form-step4-options">
                <label><input type="radio" name="doc4" value="passport" checked> Passport or the application receipt*</label>
                <label><input type="radio" name="doc4" value="photo"> Profile photo</label>
              </div>

              <div class="form-step4-uploadbox" id="uploadBox">
                <i class="fa-solid fa-cloud-arrow-up" style="color:#fa5000;"></i>
                <p>Drag and Drop here<br>or</p>
                <button type="button" class="form-step4-btn" id="selectFileBtn">SELECT FILE</button>
                <input type="file" name="coach_passport" id="coach_passport" class="d-none" />
                <div id="selectedFileName" style="margin-top:8px;font-size:0.9rem;color:#333;"></div>
              </div>
            </div>

            <div class="form-step4-consent">
              <h6>Required Consents*</h6>
              <p>
                I, <?= esc(($coach['first_name'] ?? '') . ' ' . ($coach['last_name'] ?? '')) ?> have read, completed and electronically signed the following documents:
              </p>
              <p>
                <label><input type="checkbox" name="consent_waiver" checked> The
                  <a href="#">Gatorade 5V5 Tournament Waiver</a> - CLICK TO PROCEED*
                </label>
                <i class="fa-solid fa-arrow-up-right-from-square" style="color:#fa5000;"></i>
              </p>
              <p>
                <label><input type="checkbox" name="consent_code" checked> The
                  <a href="#">Gatorade 5V5 Tournament Code of Conduct</a> - CLICK TO PROCEED*
                </label>
                <i class="fa-solid fa-arrow-up-right-from-square" style="color:#fa5000;"></i>
              </p>
            </div>

            <div class="form-step4-consent">
              <h6>Marketing Consents*</h6>
              <p>
                <label><input type="checkbox" name="marketing_email" checked> By checking this box, you are opting in to receive additional emails with product information, news, and special offers from Gatorade and other PepsiCo brands. Please see our
                  <a href="#">Privacy Policy</a>, <a href="#">Terms of Use</a>, and <a href="#">About our Ads</a> for details.
                </label>
              </p>
              <p>
                <label><input type="checkbox" name="marketing_sms" checked> By checking this box, you consent to receive recurring texts (including automated texts) from and on behalf of Gatorade and PepsiCo brands with product info, news, and offers to the phone number you entered above. Text STOP to opt-out at any time. Subject to
                  <a href="#">Terms &amp; Conditions</a> and <a href="#">Privacy Policy</a>.
                </label>
              </p>
            </div>

            <div class="form-step4-buttons">
              <button type="button" class="form-step4-prev" onclick="previousStep(4)">PREVIOUS</button>
              <button type="submit" class="form-step4-finish">FINISH</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function(){
      var fileInput = document.getElementById('coach_passport');
      var selectBtn = document.getElementById('selectFileBtn');
      var selectedName = document.getElementById('selectedFileName');
      var uploadBox = document.getElementById('uploadBox');

      selectBtn.addEventListener('click', function(){ fileInput.click(); });
      fileInput.addEventListener('change', function(){
        selectedName.textContent = this.files.length ? this.files[0].name : '';
      });

      // simple drag & drop
      ['dragenter','dragover'].forEach(function(e){ uploadBox.addEventListener(e, function(ev){ ev.preventDefault(); uploadBox.classList.add('drag-over'); }); });
      ['dragleave','drop'].forEach(function(e){ uploadBox.addEventListener(e, function(ev){ ev.preventDefault(); uploadBox.classList.remove('drag-over'); }); });
      uploadBox.addEventListener('drop', function(ev){
        var files = ev.dataTransfer.files;
        if(files && files.length){
          fileInput.files = files;
          selectedName.textContent = files[0].name;
        }
      });
    })();
  </script>
</form>
<?= $this->include('layouts/footer') ?>
