<div class="tab-pane fade <?= ($activeTab??'dashboard')==='athletes'?'show active':'' ?>" id="athletes" role="tabpanel" aria-labelledby="athletes-tab">
  <div class="athletes-brand mb-3">
    <div class="brand-text">
      <div class="brand-title">COACH DASHBOARD</div>
      <div class="brand-subtitle">TEAM <span class="team-name"><?= esc($coach['team_name'] ?? 'team-name') ?></span></div>
    </div>
  </div>
  <div class="athletes-table-wrapper">
    <table class="athletes-table">
      <thead>
        <tr class="athletes-table-header-row">
          <th class="athletes-table-header-cell">POSITION</th>
          <th class="athletes-table-header-cell">FIRST NAME</th>
          <th class="athletes-table-header-cell">LAST NAME</th>
          <th class="athletes-table-header-cell">E-MAIL</th>
          <th class="athletes-table-header-cell">CODE</th>
          <th class="athletes-table-header-cell">STATUS</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($athletes as $i => $a): ?>
          <?php $isConfirmed = in_array($a['status'], ['athlete_completed','athlete_profile_entered','athlete_documents_uploaded']); ?>
          <tr>
            <td>Roster #<?= $i+1 ?></td>
            <td><?= esc($a['first_name']) ?></td>
            <td><?= esc($a['last_name']) ?></td>
            <td><a href="mailto:<?= esc($a['email']) ?>"><?= esc($a['email']) ?></a></td>
            <td><code class="invite-code"><?= esc($a['invitation_code']) ?></code></td>
            <td><span class="status-badge <?= $isConfirmed ? 'confirmed':'pending' ?>"><?= $isConfirmed? 'CONFIRMED':'PENDING' ?></span></td>
          </tr>
        <?php endforeach; ?>
        <?php if(empty($athletes)): ?>
          <tr><td colspan="6" class="text-center py-4">No athletes added yet.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
