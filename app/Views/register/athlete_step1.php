<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="athlete-step1" role="tabpanel">
  <div class="row">
    <div class="col-md-11 form-left d-flex align-items-start">
      <div class="logo-wrapper">
        <img src="<?= base_url('asset/Isolation_Mode.svg') ?>" alt="Left Side Image" class="logo-shape1">
      </div>

      <div class="form-content w-100">
        <h6 class="mb-3">Hello, to register as an athlete, please complete the form below using your email address and the invitation code provided by your coach.</h6>

        <?php $fieldErrors = $fieldErrors ?? []; ?>
        <?php if(!empty($error)): ?><div class="alert alert-danger"><?= esc($error) ?></div><?php endif; ?>
        <style>
          .inline-error{color:#d9534f;font-size:0.8rem;margin-top:4px;}
          .has-error input{border-color:#d9534f;}
        </style>

        <form method="post" class="needs-validation" novalidate>
          <?= csrf_field() ?>

          <div class="mb-3 <?= isset($fieldErrors['email'])? 'has-error':'' ?>">
            <label for="athleteEmail">E-mail*</label>
            <input id="athleteEmail" type="email" name="email" class="form-control" value="<?= esc(old('email')) ?>" required>
            <?php if(isset($fieldErrors['email'])): ?><div class="inline-error"><?= esc($fieldErrors['email']) ?></div><?php endif; ?>
          </div>

          <div class="mb-3 <?= isset($fieldErrors['invitation_code'])? 'has-error':'' ?>">
            <label for="inviteCode">Invitation Code*</label>
            <input id="inviteCode" type="text" name="invitation_code" class="form-control" value="<?= esc(old('invitation_code')) ?>" required>
            <?php if(isset($fieldErrors['invitation_code'])): ?><div class="inline-error"><?= esc($fieldErrors['invitation_code']) ?></div><?php endif; ?>
          </div>

          <div class="mt-3 d-flex align-items-center">
            <button type="submit" class="btn btn-primary btn-next">
              <span class="btn-text">NEXT</span>
            </button>
            <a href="#" class="ms-3 rules-link align-self-center" style="position:absolute; top:109%; left:45%;">Gatorade 5v5 Tournament – General Rules</a>
          </div>
        </form>
        <script>
          (function(){
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e){
              let ok = true;
              const email = document.getElementById('athleteEmail');
              const code = document.getElementById('inviteCode');
              // remove previous client errors
              form.querySelectorAll('.inline-error.client').forEach(n=>n.remove());
              if(!email.value.trim()) { ok=false; addErr(email,'Email required'); }
              if(!code.value.trim()) { ok=false; addErr(code,'Invitation code required'); }
              if(!ok) e.preventDefault();
              function addErr(input,msg){
                input.classList.add('is-invalid');
                const div=document.createElement('div');
                div.className='inline-error client';
                div.textContent=msg;
                input.parentElement.appendChild(div);
              }
            });
          })();
        </script>
      </div>
    </div>

   
    </div>
  </div>
 </div>
<?= $this->include('layouts/footer') ?>