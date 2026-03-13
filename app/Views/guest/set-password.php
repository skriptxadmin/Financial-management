<?= $this->extend("layouts/basic") ?>

<?= $this->section('title') ?>
   Set Password Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
  <div class="row w-100">
    <div class="col-12 col-md-6 col-lg-4 mx-auto">

      <div class="card shadow-sm" style="border:none; border-radius:16px;">

        <!-- Header -->
        <div class="card-header bg-white text-center border-0" style="padding: 2rem 2rem 1rem; border-radius: 16px 16px 0 0 !important;">
          <div class="mx-auto mb-3 d-flex align-items-center justify-content-center bg-primary text-white" style="width:52px; height:52px; border-radius:14px;">
            <i class="bi bi-person-fill fs-4"></i>
          </div>
        <h5 class="fw-bold mb-1">Set Your New Password</h5>
<p class="text-muted small mb-0">Choose a strong password to secure your account</p>
        </div>

        <!-- Body -->
        <div class="card-body" style="padding: 1.5rem 2rem 2rem;">
          <form method="post" class="set-password">
            <input type="hidden" name="username" id="username" value="<?= $username ?>">
            <!-- Username -->
            <div class="form-group mb-3">
              <label for="otp" class="form-label fw-medium">One time password</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="otp" name="otp"
                  placeholder="Enter one time password" autocomplete="one-time-code"value="<?= $otp ?>" >
              </div>
            </div>

            <!-- Password -->
            <div class="form-group  mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <label for="password" class="form-label fw-medium mb-0">Password</label>
                </div>
              <div class="input-group mt-1">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password"
                  placeholder="Enter your password" autocomplete="new-password">
              </div>
            </div>

             <div class="form-group mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <label for="cpassword" class="form-label fw-medium mb-0">Confim Password</label>
                </div>
              <div class="input-group mt-1">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" id="cpassword" name="cpassword"
                  placeholder="Reenter your password" autocomplete="new-password">
              </div>
            </div>

            <!-- Submit -->
            <div class="d-grid">
              <button type="submit" class="btn btn-primary fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i> Set Password
              </button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/guest/set-password.js') ?>"></script>
<?= $this->endSection() ?>