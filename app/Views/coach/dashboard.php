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

<div class="container main-section py-4">
  <div class="row">
    <div class="col-md-3 col-lg-2 sidebar p-0">
      <div class="sidebar-inner">
        <ul class="nav flex-column">
          <li class="nav-item"><a href="#" class="nav-link active d-flex align-items-center"><img src="<?= base_url('asset/navbar/Rectangle 2.svg') ?>" class="me-3" width="20" alt="">Dashboard</a></li>
          <li class="nav-item"><a href="<?= site_url('/register/coach/step3?coach_id='.urlencode($coachId)) ?>" class="nav-link d-flex align-items-center"><img src="<?= base_url('asset/navbar/Rectangle 2.svg') ?>" class="me-3" width="20" alt="">Athletes</a></li>
          <li class="nav-item"><a href="#" class="nav-link d-flex align-items-center"><img src="<?= base_url('asset/navbar/Rectangle 2.svg') ?>" class="me-3" width="20" alt="">Parents/Guardians</a></li>
          <li class="nav-item"><a href="<?= site_url('/register/coach/step4?coach_id='.urlencode($coachId)) ?>" class="nav-link d-flex align-items-center"><img src="<?= base_url('asset/navbar/Rectangle 2.svg') ?>" class="me-3" width="20" alt="">Waivers</a></li>
          <li class="nav-item"><a href="#" class="nav-link d-flex align-items-center"><img src="<?= base_url('asset/navbar/Rectangle 2.svg') ?>" class="me-3" width="20" alt="">Qualifiers Calendar</a></li>
          <li class="nav-item"><a href="#" class="nav-link d-flex align-items-center"><img src="<?= base_url('asset/navbar/Rectangle 2.svg') ?>" class="me-3" width="20" alt="">Help</a></li>
        </ul>
      </div>
    </div>

    <div class="col-md-9 col-lg-10 dashboard-content">
      <div class="mb-4">
        <h4 class="fw-bold coach-dashboard-title">COACH DASHBOARD TEAM</h4>
        <p class="team-name"><?= esc($coach['team_name'] ?? '{team-name}') ?></p>
      </div>

      <div class="row g-3 mb-4 text-center">
        <div class="col-md-3 col-6">
          <div class="stat-box ticket">
            <div class="stat-title">Approved Athletes</div>
            <div class="stat-value"><?= esc($approvedAthletes) ?>/<?= esc($totalAthletes) ?></div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="stat-box ticket">
            <div class="stat-title">Waivers Signed</div>
            <div class="stat-value"><?= esc($waiversSigned) ?></div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="stat-box ticket">
            <div class="stat-title">Parents Accepted</div>
            <div class="stat-value"><?= esc($acceptedParents) ?>/<?= esc($totalParents) ?></div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="stat-box ticket">
            <div class="stat-title">Team Position</div>
            <div class="stat-value"># / queue</div>
          </div>
        </div>
      </div>

      <div class="card border-0 shadow-sm p-4">
        <div class="d-flex justify-content-start mb-4">
          <ul class="nav nav-tabs custom-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">My details ✎</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab">My Address 📍</button>
            </li>
          </ul>
        </div>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane show active" id="details" role="tabpanel">
            <div class="row">
              <div class="col-md-3 text-center">
                <div class="profile-pic mb-2">
                    <img src="<?= base_url('asset/main section/Isolation_Mode.svg') ?>" alt="Coach" class="rounded-circle" onerror="this.src='https://via.placeholder.com/120'">
                </div>
                <h6 class="fw-bold mb-0"><?= esc(($coach['first_name'] ?? '').' '.($coach['last_name'] ?? '')) ?></h6>
                <small class="text-warning fw-bold">COACH</small>
              </div>

              <div class="col-md-9">
                <form>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">First Name*</label>
                      <input type="text" class="form-control" value="<?= esc($coach['first_name'] ?? '') ?>" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">E-mail*</label>
                      <input type="email" class="form-control" value="<?= esc($coach['email'] ?? '') ?>" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Middle Name</label>
                      <input type="text" class="form-control" value="<?= esc($coach['middle_name'] ?? '') ?>" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Phone Number*</label>
                      <input type="text" class="form-control" value="<?= esc($coach['phone'] ?? '') ?>" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Last Name*</label>
                      <input type="text" class="form-control" value="<?= esc($coach['last_name'] ?? '') ?>" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Date of Birth*</label>
                      <input type="text" class="form-control" value="<?= esc($coach['dob'] ?? '') ?>" readonly>
                    </div>
                  </div>
                  <div class="mt-4">
                    <p class="text-danger small mb-2 fw-bold">Change your password</p>
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label class="form-label">New Password*</label>
                        <input type="password" class="form-control" disabled>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Retype New Password*</label>
                        <input type="password" class="form-control" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="mt-4">
                    <a href="<?= site_url('/register/coach/step3?coach_id='.urlencode($coachId)) ?>" class="btn btn-save"><span class="btn-text">GO TO ROSTER</span></a>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="address" role="tabpanel">
            <form>
              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label">Address Line 1*</label>
                  <input type="text" class="form-control" value="<?= esc($coach['address_line1'] ?? '') ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Address 2</label>
                  <input type="text" class="form-control" value="<?= esc($coach['address_line2'] ?? '') ?>" readonly>
                </div>
                <div class="col-md-4">
                  <label class="form-label">City*</label>
                  <input type="text" class="form-control" value="<?= esc($coach['city'] ?? '') ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label class="form-label">State*</label>
                  <input type="text" class="form-control" value="<?= esc($coach['state'] ?? '') ?>" readonly>
                </div>
                <div class="col-md-6">
                  <label class="form-label">ZIP / Postal Code*</label>
                  <input type="text" class="form-control" value="<?= esc($coach['zip_code'] ?? '') ?>" readonly>
                </div>
              </div>
              <div class="mt-4">
                <a href="<?= site_url('/register/coach/step4?coach_id='.urlencode($coachId)) ?>" class="btn btn-save"><span class="btn-text">GO TO DOCUMENTS</span></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->include('layouts/footer') ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
