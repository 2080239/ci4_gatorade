<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= isset($title) ? esc($title) : 'Gatorade 5v5' ?></title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font used in your example -->
  <link href="https://fonts.googleapis.com/css2?family=Pano:wght@400;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Your local CSS files (use base_url so CI can resolve paths) -->
  <link href="<?= base_url('css/headerfooter.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/step.css') ?>" rel="stylesheet">
  <link href="<?= base_url('css/coach-dashboard.css') ?>" rel="stylesheet">
</head>
<body>

<?php
  // Fallback: auto-detect current step from URL if not provided
  if (!isset($currentStep)) {
    try {
      $uri = function_exists('service') ? service('uri') : null;
      $path = $uri ? strtolower($uri->getPath()) : '';
      $flat = preg_replace('/[^a-z0-9]/i', '', (string)$path);
      if (preg_match('/step([1-4])/', $flat, $m)) {
        $currentStep = (int)$m[1];
      }
    } catch (Throwable $e) {
      // ignore; header will just render without active step
    }
  }
?>

  <!-- HEADER -->
<header class="gatorade-header d-flex align-items-center justify-content-between px-4" style="background-image: url('<?= base_url('asset/Rectangle 1.png') ?>');">
  <!-- Left Logo -->
  <div class="header-logo">
    <img src="<?= base_url('asset/navbar/Group.svg') ?>" alt="Logo Shape" class="logo-shape">
    <p class="logo-text gatorade-text">Gatorade</p>
    <p class="logo-text fivev5-text">5v5</p>
  </div>

  <!-- Center Title -->
  <h6 class="header-title mb-0 text-white">WELCOME, LET’S REGISTER YOUR TEAM</h6>

  <!-- Right Step Box -->
  <div class="step-box">
    <?= isset($currentStep) && $currentStep >= 1 && $currentStep <= 4 ? 'STEP ' . $currentStep : 'STEP' ?>
  </div>
</header>

  <div class="container my-4" >
    <div class="form-frame">

      
        <div class="steps-wrapper">
      <div class="step <?= (isset($currentStep) && $currentStep == 1) ? 'active' : '' ?>" aria-current="<?= (isset($currentStep) && $currentStep == 1) ? 'page' : 'false' ?>">
        <div class="step-inner">STEP 1</div>
      </div>
      <div class="step <?= (isset($currentStep) && $currentStep == 2) ? 'active' : '' ?>" aria-current="<?= (isset($currentStep) && $currentStep == 2) ? 'page' : 'false' ?>">
        <div class="step-inner">STEP 2</div>
      </div>
      <div class="step <?= (isset($currentStep) && $currentStep == 3) ? 'active' : '' ?>" aria-current="<?= (isset($currentStep) && $currentStep == 3) ? 'page' : 'false' ?>">
        <div class="step-inner">STEP 3</div>
      </div>
      <div class="step <?= (isset($currentStep) && $currentStep == 4) ? 'active' : '' ?>" aria-current="<?= (isset($currentStep) && $currentStep == 4) ? 'page' : 'false' ?>">
        <div class="step-inner">STEP 4</div>
      </div>
        </div>

      <!-- Tab Content -->
      <div class="tab-content" id="registrationStepsContent">