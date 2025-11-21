<?= $this->include('layouts/header') ?>
<div class="tab-pane show active" id="athlete-finish" role="tabpanel">
  <div class="form-step4-frame">
    <div class="steps-wrapper">
      <div class="step"><div class="step-inner">STEP 1</div></div>
      <div class="step"><div class="step-inner">STEP 2</div></div>
      <div class="step active"><div class="step-inner">STEP 3</div></div>
    </div>

    <?php
      $firstName = $athlete['first_name'] ?? '';
      $teamName = $athlete['team_name'] ?? 'your team';
      $region   = $athlete['qualifier_city'] ?? 'your region';
      $athleteId = $athlete['id'] ?? null;
    ?>

    <div style="max-width: 780px; margin: 30px auto; background:#fff; border-radius: 6px; box-shadow: 0 10px 36px rgba(0,0,0,0.35); padding: 28px 26px; border: 1px solid #e7e7e7;">
      <h5 style="font-weight:700; margin-bottom:14px;">Well done, <span style="color:#ef5a22;"><?= esc($firstName) ?></span>!</h5>

      <p style="margin-bottom:14px;">
        You have been registered to compete with the <strong><?= esc($teamName) ?></strong> team
        at the Gatorade 5V5 Tournament at the <strong><?= esc($region) ?></strong> qualifier.
      </p>

      <p style="margin-bottom:14px;"><strong>Please note:</strong> your registration is currently conditional.
        Team acceptance will be determined in the order in which complete registrations are received. A registration is
        considered complete only when all required athletes and coach information, along with the signed
        <strong>Tournament Waiver</strong> and <strong>Code of Conduct</strong> (collectively referred to as the
        "Required Consents"), have been submitted and verified. Only the first <strong>32 fully completed teams per division</strong>
        (boys and girls) will be accepted.
      </p>

      <p style="margin-bottom:14px;">
        A confirmation email has been sent to you, your coach, and your parent / legal guardian allowing them to provide any
        missing information and complete the Required Consents electronically.
      </p>

      <p style="margin-bottom:14px;">
        Final acceptance notifications will be sent no later than <strong>January 10, 2026</strong> (and may be communicated earlier)
        via email to you and all registered athletes.
      </p>

      <p style="margin-bottom:6px;">
        Thank you for completing the registration process. We look forward to seeing your team take the field.
      </p>

      <div style="display:flex; gap:18px; justify-content:center; margin-top:26px;">
        <a href="<?= $athleteId ? site_url('register/athlete/resend-confirmation?athlete_id='.$athleteId) : '#' ?>" class="btn-previous">RESEND EMAIL</a>
        <a href="<?= site_url('register/athlete/step1') ?>" class="btn-finish">FINISH</a>
      </div>
    </div>
  </div>
</div>
<?= $this->include('layouts/footer') ?>