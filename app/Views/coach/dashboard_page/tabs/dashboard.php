<div class="tab-pane fade <?= ($activeTab??'dashboard')==='dashboard'?'show active':'' ?>" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
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
        <div class="stat-value">#<?= esc($queueRank) ?> / <?= esc($queueTotal) ?></div>
      </div>
    </div>
  </div>
  <div class="card border-0 shadow-sm p-4">
    <ul class="nav nav-tabs inner-tabs mb-4" id="coachInnerTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">
          My Details <span class="ms-1">✎</span>
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">
          My Address <span class="ms-1">📍</span>
        </button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
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
      <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
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
