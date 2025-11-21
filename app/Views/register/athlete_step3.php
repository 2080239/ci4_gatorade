<?= $this->include('layouts/header') ?>
<form method="post" enctype="multipart/form-data" class="tab-pane show active" id="athlete-step3" role="tabpanel">
  <?= csrf_field() ?>
  <input type="hidden" name="athlete_id" value="<?= esc($athlete['id']) ?>">

  <div class="form-step4-frame">
    

    <div class="container">
      <div class="row">
        <div class="col-2">
          <div class="form-step4-number">
            <img src="<?= base_url('asset/step2/step3.svg') ?>" alt="Step 3 badge showing number 3 inside orange circular progress icon; indicates third athlete registration step">
          </div>
        </div>
        <div class="col-10">
          <div class="form-step4-container">
            <h5>Athlete’s documentation upload:</h5>

            <div class="form-step4-upload">
              <div class="form-step4-options">
                <label><input type="radio" name="doc_type" value="passport" checked> Passport or the application receipt*</label>
                <label><input type="radio" name="doc_type" value="photo"> Profile photo</label>
                <label style="margin-top:18px; font-weight:600;">Parent / Legal Guardian Email (optional)</label>
                <input type="email" name="parent_email" placeholder="parent@example.com" style="width:100%; padding:10px 14px; border:1px solid #ccc; border-radius:4px; font-size:14px; font-family: 'Replica-Mono', monospace;">
              </div>

              <div class="form-step4-uploadbox" id="athleteUploadBox">
                <i class="fa-solid fa-cloud-arrow-up" style="color:#fa5000;"></i>
                <p>Drag and Drop here<br>or</p>
                <button type="button" class="form-step4-btn" id="athleteSelectFileBtn">SELECT FILE</button>
                <input type="file" name="athlete_doc" id="athlete_doc" class="d-none" />
                <div id="athleteSelectedFileName" style="margin-top:8px;font-size:0.9rem;color:#333;"></div>
              </div>
            </div>

            <div class="form-step4-consent">
              <h6>Required Consents*</h6>
              <p>
                I, <?= esc(($athlete['first_name'] ?? '') . ' ' . ($athlete['last_name'] ?? '')) ?> have read, completed and electronically signed the following documents:
              </p>
              <p>
                <label><input type="checkbox" name="consent_waiver" required checked> The
                  <a href="#">Gatorade 5V5 Tournament Waiver</a> - CLICK TO PROCEED*
                </label>
                <i class="fa-solid fa-arrow-up-right-from-square" style="color:#fa5000;"></i>
              </p>
              <p>
                <label><input type="checkbox" name="consent_code" required checked> The
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
              <a href="<?= site_url('register/athlete/step2?athlete_id='.$athlete['id']) ?>" class="form-step4-prev">PREVIOUS</a>
              <button type="submit" class="form-step4-finish">FINISH</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function(){
      var fileInput = document.getElementById('athlete_doc');
      var selectBtn = document.getElementById('athleteSelectFileBtn');
      var selectedName = document.getElementById('athleteSelectedFileName');
      var uploadBox = document.getElementById('athleteUploadBox');

      selectBtn.addEventListener('click', function(){ fileInput.click(); });
      fileInput.addEventListener('change', function(){
        selectedName.textContent = this.files.length ? this.files[0].name : '';
      });

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