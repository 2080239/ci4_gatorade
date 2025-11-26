<div class="container d-flex align-items-center justify-content-center min-vh-100" style="max-width:480px;">
    <div class="card shadow-lg border-0 w-100 p-4" style="border-radius:1.5rem;background:#fff;">
        <div class="text-center mb-4">
            <img src="<?= base_url('asset/navbar/Group.svg') ?>" alt="Logo" style="width:64px;height:64px;object-fit:contain;">
            <h2 class="fw-bold mt-2 mb-1" style="font-family:'Poppins',sans-serif;letter-spacing:.5px;">Admin Login</h2>
            <p class="text-muted mb-0" style="font-size:.98rem;">Sign in to your dashboard</p>
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
            <div class="form-floating mb-3">
                <input type="email" name="email" id="email" class="form-control rounded-4" placeholder="Email" required value="<?= esc(old('email')) ?>">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" id="password" class="form-control rounded-4" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 rounded-4 fw-semibold" style="font-size:1.1rem;letter-spacing:.5px;background:#FA5000;border:none;">Login</button>
        <?= form_close(); ?>
    </div>
</div>
