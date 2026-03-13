<?= $this->extend("layouts/basic") ?>

<?= $this->section('title') ?>
   Login Page
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
          <h5 class="fw-bold mb-1">Welcome Back</h5>
          <p class="text-muted small mb-0">Sign in to your account</p>
        </div>

        <!-- Body -->
        <div class="card-body" style="padding: 1.5rem 2rem 2rem;">
          <form method="post" class="login">

            <!-- Username -->
            <div class="form-group  mb-3">
              <label for="username" class="form-label fw-medium">Email / Username</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="username" name="username"
                  placeholder="Enter email or username" autocomplete="username" value="administrator@example.com">
              </div>
            </div>

            <!-- Password -->
            <div class="form-group  mb-4">
              <div class="d-flex justify-content-between align-items-center">
                <label for="password" class="form-label fw-medium mb-0">Password</label>
                <a href="<?= base_url('forgot-password') ?>" class="small text-decoration-none">Forgot Password?</a>
              </div>
              <div class="input-group mt-1">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password"
                  placeholder="Enter your password" autocomplete="current-password" value="Password@123">
              </div>
            </div>

            <!-- Submit -->
            <div class="d-grid">
              <button type="submit" class="btn btn-primary fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i> Login
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
   <script src="<?= base_url('scripts/guest/login.js') ?>"></script>
<?= $this->endSection() ?>