<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - Gatorade 5v5</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Pano:wght@400;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Local CSS -->
  <link href="<?= base_url('css/headerfooter.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/step.css') ?>" rel="stylesheet">
  <style>
      /* Custom overrides for login page */
      .login-container {
          max-width: 500px;
          margin: 50px auto;
      }
      .login-card {
          background: #ffffffe6; /* Match form-frame */
          border-radius: 6px;
          box-shadow: 0 8px 20px rgba(0,0,0,0.5);
          padding: 40px;
      }
      .login-title {
          font-family: "HW Pano Trial", sans-serif;
          font-weight: 700;
          color: #111;
          margin-bottom: 10px;
      }
      .form-control {
          font-family: "Replica-Mono", monospace;
          border-radius: 4px;
          padding: 12px;
      }
      .form-control:focus {
          border-color: #ef5a22;
          box-shadow: 0 0 0 0.25rem rgba(239, 90, 34, 0.25);
      }
      .btn-login {
          background: #ef5a22;
          color: white;
          border: none;
          padding: 12px 0;
          font-weight: bold;
          clip-path: polygon(0% 0%, 95% 0, 100% 100%, 5% 100%);
          width: 100%;
          margin-top: 20px;
          transition: background 0.3s;
      }
      .btn-login:hover {
          background: #ff7f47;
      }
      /* Hide step box for login */
      .step-box {
          visibility: hidden;
      }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header class="gatorade-header d-flex align-items-center justify-content-between px-4" style="background-image: url('<?= base_url('asset/Rectangle 1.png') ?>');">
    <!-- Left Logo -->
    <div class="header-logo">
      <img src="<?= base_url('asset/navbar/Group.svg') ?>" alt="Logo Shape" class="logo-shape">
      <p class="logo-text gatorade-text">Gatorade</p>
      <p class="logo-text fivev5-text">5v5</p>
    </div>

    <!-- Center Title -->
    <h6 class="header-title mb-0 text-white">ADMIN LOGIN</h6>

    <!-- Right Step Box (Hidden but kept for spacing if needed, or just empty div) -->
    <div class="step-box" style="opacity: 0;">
      STEP
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <div class="container login-container">
      <div class="login-card">
          <div class="text-center mb-4">
              <h3 class="login-title">WELCOME BACK</h3>
              <p class="text-muted" style="font-family: 'Replica-Mono', monospace;">Sign in to your dashboard</p>
          </div>

          <?php if (session()->getFlashdata('error')): ?>
              <div class="alert alert-danger text-center small"><?= esc(session()->getFlashdata('error')) ?></div>
          <?php endif; ?>
          <?php if (!empty($error)): ?>
              <div class="alert alert-danger text-center small"><?= esc($error) ?></div>
          <?php endif; ?>
          <?php if (session()->getFlashdata('success')): ?>
              <div class="alert alert-success text-center small"><?= esc(session()->getFlashdata('success')) ?></div>
          <?php endif; ?>

          <?= form_open('/login'); ?>
          <?= csrf_field() ?>
              <div class="mb-3">
                  <label for="email" class="form-label fw-bold" style="font-family: 'Replica-Mono', monospace;">Email Address</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required value="<?= esc(old('email')) ?>">
              </div>
              <div class="mb-4">
                  <label for="password" class="form-label fw-bold" style="font-family: 'Replica-Mono', monospace;">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
              </div>
              <button type="submit" class="btn-login">LOGIN</button>
          <?= form_close(); ?>
      </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer-section">
  <div class="container py-1 position-relative form-frame1 mb-3">
    <!-- Title -->
    <h3 class="text-center fw-bold mb-4 footer-title">GATORADE 5V5 TOURNAMENT</h3>
    
    <div class="row justify-content-center align-items-center">
      <!-- Left Image -->
      <div class="col-md-1 d-none d-md-block">
        <img src="<?= base_url('asset/footer/Frame 6.svg') ?>" alt="" class="footer-img-left img-fluid">
      </div>

      <!-- Player Image -->
      <div class=" text-center mb-4 mb-md-0">
        <img src="<?= base_url('asset/footer/boy2 1.svg') ?>" alt="Football Player" class="footer-player img-fluid">
      </div>

      <!-- Links -->
      <div class="col-md-7 d-flex justify-content-around flex-wrap footer-links">
        <ul class="list-unstyled ">
          <li><a href="#">About Gatorade 5v5</a></li>
          <li><a href="#">Regional Qualifiers Schedule</a></li>
          <li><a href="#">Gallery</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Tournament Rules</a></li>
          <li><a href="#">Code of Conduct</a></li>
        </ul>

        <ul class="list-unstyled ">
          <li><a href="#">Press Inquiries</a></li>
          <li><a href="#">Privacy Notice</a></li>
          <li><a href="#">Terms of Use</a></li>
          <li><a href="#">Team’s support</a></li>
          <li><a href="#">Athlete and Coach Waivers</a></li>
        </ul>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center small mt-4 footer-copy">
      © <?= date('Y') ?> Stokely-Van Camp, Inc. All Rights Reserved.
    </div>

    <!-- Right Logo -->
    <div class="position-absolute footer-logo">
      <img src="<?= base_url('asset/footer/5v5-logo2 2.svg') ?>" alt="Logo">
    </div>
  </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

