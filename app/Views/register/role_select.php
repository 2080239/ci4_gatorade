<?php // app/Views/register/role_select.php ?>
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5" style="max-width: 900px;">

  <h2 class="text-center mb-4">Welcome to Gatorade 5V5 Registration</h2>
  <p class="text-center text-muted mb-5">
    Select how you want to continue. Coaches create teams & invite athletes/parents.  
    Parents and Athletes join using invitation codes sent by the coach.
  </p>

  <div class="row g-4">

    <!-- COACH CARD -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100 border-0">
        <div class="card-body d-flex flex-column text-center">
          <h5 class="fw-bold mb-3">Coach</h5>

          <p class="text-muted mb-4 flex-grow-1">
            Create your team, add roster (6 required + 2 reserves)  
            and send invitations to Parents & Athletes.
          </p>

          <a href="<?= base_url('register/coach/step1') ?>"
             class="btn btn-primary w-100 fw-bold">
            Start as Coach
          </a>
        </div>
      </div>
    </div>

    <!-- PARENT CARD -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100 border-0">
        <div class="card-body d-flex flex-column text-center">
          <h5 class="fw-bold mb-3">Parent</h5>

          <p class="text-muted mb-3 flex-grow-1">
            Received an invite from your child’s coach?  
            Enter the invitation code & email to begin registration.
          </p>

          <a href="<?= base_url('invite/parent') ?>"
             class="btn btn-outline-primary w-100 fw-bold">
            I have an Invite
          </a>
        </div>
      </div>
    </div>

    <!-- ATHLETE CARD -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100 border-0">
        <div class="card-body d-flex flex-column text-center">
          <h5 class="fw-bold mb-3">Athlete</h5>

          <p class="text-muted mb-3 flex-grow-1">
            Athletes register with the invitation code  
            provided by the coach.
          </p>

          <a href="<?= base_url('invite/athlete') ?>"
             class="btn btn-outline-primary w-100 fw-bold">
            I have an Invite
          </a>
        </div>
      </div>
    </div>

  </div>

  <div class="text-center mt-4">
    <small class="text-muted">
      If you received a link via email, simply click it — your code & email auto-fill.
    </small>
  </div>

</div>

<?= $this->endSection() ?>
