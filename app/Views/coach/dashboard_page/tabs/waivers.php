<div class="tab-pane fade <?= ($activeTab??'dashboard')==='waivers'?'show active':'' ?>" id="waivers" role="tabpanel" aria-labelledby="waivers-tab">
  <div class="waivers-stats-container">
    <div class="stats-grid">
      <div class="stat-card">
        <h3>Team's Position in approval queue</h3>
        <p><span class="orange-txt">#<?= esc($queueRank) ?></span>/<?= esc($queueTotal) ?></p>
      </div>
      <div class="stat-card">
        <h3>Approved Athletes</h3>
        <p><span class="orange-txt"><?= esc($approvedAthletes) ?></span>/<?= esc($totalAthletes) ?></p>
      </div>
      <div class="stat-card">
        <h3>Parent/Guardian invitations accepted</h3>
        <p><span class="orange-txt"><?= esc($acceptedParents) ?></span>/<?= esc($totalParents) ?></p>
      </div>
      <div class="stat-card">
        <h3>Waivers Signed</h3>
        <p><span class="orange-txt"><?= esc($waiversSigned) ?></span></p>
      </div>
    </div>
    <div class="not-approved-explanations">
      <div class="not-approved-section">
        <div class="not-approved-header"><span class="warning-icon">!</span><span class="not-approved-text">NOT APPROVED</span></div>
        <div class="not-approved-content"><p>Complete all waivers and documents to secure approval.</p></div>
      </div>
      <div class="not-approved-section">
        <div class="not-approved-header"><span class="warning-icon">!</span><span class="not-approved-text">NOT APPROVED</span></div>
        <div class="not-approved-content"><p>Ensure all athletes have finished registration.</p></div>
      </div>
    </div>
  </div>
</div>
