<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coach Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/headerfooter.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/coach-dashboard.css') ?>">
  <!-- Per-tab styles -->
  <link rel="stylesheet" href="<?= base_url('css/tabs/dashboard-tab.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/tabs/athletes-tab.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/tabs/parents-tab.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/tabs/waivers-tab.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/tabs/calendar-tab.css') ?>">
  <link rel="stylesheet" href="<?= base_url('css/tabs/help-tab.css') ?>">
</head>
<body>
<header class="gatorade-header d-flex align-items-center justify-content-between px-4">
  <div class="header-logo">
    <img src="<?= base_url('asset/navbar/Group.svg') ?>" alt="Logo Shape" class="logo-shape">
    <p class="logo-text gatorade-text">Gatorade</p>
    <p class="logo-text fivev5-text">5v5</p>
  </div>
  <h6 class="header-title mb-0 text-white">WELCOME, LET’S REGISTER YOUR TEAM</h6>
  <div class="step-box">DASHBOARD</div>
</header>

<div class="container main-section py-4" style="max-width: 1231px;">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar p-0">
            <?= $this->include('coach/partials/sidebar') ?>
        </div>

        <div class="col-md-9 col-lg-10 dashboard-content">
            <div class="tab-content" id="dashboardTabContent">
                <!-- Included tab panes -->
                <?= $this->include('coach/dashboard_page/tabs/dashboard') ?>
                <?= $this->include('coach/dashboard_page/tabs/athletes') ?>
                <?= $this->include('coach/dashboard_page/tabs/parents') ?>
                <?= $this->include('coach/dashboard_page/tabs/waivers') ?>
                <?= $this->include('coach/dashboard_page/tabs/calendar') ?>
                <?= $this->include('coach/dashboard_page/tabs/help') ?>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
