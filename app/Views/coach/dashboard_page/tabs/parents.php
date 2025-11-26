<div class="tab-pane fade <?= ($activeTab??'dashboard')==='parents'?'show active':'' ?>" id="parents" role="tabpanel" aria-labelledby="parents-tab">
  <div class="mb-4">
    <h4 class="fw-bold coach-dashboard-title">Parents / Guardians</h4>
    <p class="text-muted">Invitations and documents</p>
  </div>
  <div class="athletes-table-wrapper">
    <table class="athletes-table">
      <thead>
        <tr>
          <th>PARENT/GUARDIAN</th>
          <th>E-MAIL</th>
          <th>CODE</th>
          <th>INVITATION STATUS</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($parents as $p): ?>
          <?php $accepted = in_array($p['status'], ['parent_completed','parent_athlete_verified','parent_profile_entered']); ?>
          <tr>
            <td><?= esc($p['first_name'].' '.$p['last_name']) ?></td>
            <td><a href="mailto:<?= esc($p['email']) ?>"><?= esc($p['email']) ?></a></td>
            <td><?= esc($p['invitation_code']) ?></td>
            <td><span class="status-badge <?= $accepted ? 'confirmed':'pending' ?>"><?= $accepted? 'ACCEPTED':'PENDING' ?></span></td>
          </tr>
        <?php endforeach; ?>
        <?php if(empty($parents)): ?>
          <tr><td colspan="4" class="text-center py-4">No parent invitations yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
