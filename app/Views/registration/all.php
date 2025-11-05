<?php // app/Views/registration/all.php ?>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>All Registrations</h2>
    <div>
      <a href="<?= base_url('register/step1') ?>" class="btn btn-primary">New Registration</a>
      
      <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
    </div>
  </div>

  <?php if (empty($records)): ?>
    <div class="alert alert-info">No registrations found.</div>
  <?php else: ?>
    <?php foreach ($records as $row): $team = $row['team']; $coach = $row['coach']; $athletes = $row['athletes']; ?>
      <div class="card mb-4">
        <div class="card-header">
          <strong>Team:</strong> <?= esc($team['team_name'] ?? '—') ?>
          <span class="text-muted ms-2">(<?= esc($team['division'] ?? 'N/A') ?>)</span>
        </div>
        <div class="card-body">
          <div class="row mb-3">
            <div class="col-md-4">
              <h5 class="mb-2">Team Info</h5>
              <ul class="list-unstyled mb-0">
                <li><strong>Qualifier City:</strong> <?= esc($team['qualifier_city'] ?? '—') ?></li>
                <li><strong>Division:</strong> <?= esc($team['division'] ?? '—') ?></li>
                <li>
                  <strong>Document:</strong>
                  <?php if (!empty($team['document'])): ?>
                    <div class="mt-2">
                      <a href="<?= base_url('uploads/' . rawurlencode($team['document'])) ?>" target="_blank">Open</a>
                      <div class="mt-2">
                        <img src="<?= base_url('uploads/' . rawurlencode($team['document'])) ?>" alt="Team Document" style="max-width:160px;max-height:120px;object-fit:cover;border:1px solid #ddd;padding:2px;border-radius:4px;">
                      </div>
                    </div>
                  <?php else: ?>
                    —
                  <?php endif; ?>
                </li>
              </ul>
            </div>
            <div class="col-md-8">
              <h5 class="mb-2">Coach</h5>
              <?php if ($coach): ?>
                <div class="row g-2">
                  <div class="col-sm-6"><strong>Name:</strong> <?= esc(trim(($coach['first_name'] ?? '').' '.($coach['last_name'] ?? ''))) ?></div>
                  <div class="col-sm-3"><strong>Phone:</strong> <?= esc($coach['phone'] ?? '—') ?></div>
                  <div class="col-sm-3"><strong>Email:</strong> <?= esc($coach['email'] ?? '—') ?></div>
                </div>
                <div class="row g-2 mt-1">
                  <div class="col-sm-12">
                    <strong>Address:</strong> <?= esc($coach['address1'] ?? '') ?> <?= esc($coach['address2'] ?? '') ?>, <?= esc($coach['city'] ?? '') ?>, <?= esc($coach['state'] ?? '') ?> <?= esc($coach['zip'] ?? '') ?>
                  </div>
                </div>
              <?php else: ?>
                <div class="text-muted">No coach record</div>
              <?php endif; ?>
            </div>
          </div>

          <h5 class="mt-3">Athletes</h5>
          <?php if (empty($athletes)): ?>
            <div class="text-muted">No athletes added.</div>
          <?php else: ?>
            <div class="table-responsive">
              <table class="table table-sm table-bordered align-middle">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>First</th>
                    <th>Middle</th>
                    <th>Last</th>
                    <th>DOB</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Parent Name</th>
                    <th>Parent Email</th>
                    <th>Parent Phone</th>
                    <th>Reserve?</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($athletes as $i => $a): ?>
                    <tr>
                      <td><?= $i+1 ?></td>
                      <td><?= esc($a['first_name'] ?? '—') ?></td>
                      <td><?= esc($a['middle_name'] ?? '—') ?></td>
                      <td><?= esc($a['last_name'] ?? '—') ?></td>
                      <td><?= esc($a['dob'] ?? '—') ?></td>
                      <td><?= esc($a['phone'] ?? '—') ?></td>
                      <td><?= esc($a['email'] ?? '—') ?></td>
                      <td><?= esc($a['parent_name'] ?? '—') ?></td>
                      <td><?= esc($a['parent_email'] ?? '—') ?></td>
                      <td><?= esc($a['parent_phone'] ?? '—') ?></td>
                      <td><?= !empty($a['is_reserve']) ? 'Yes' : 'No' ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
