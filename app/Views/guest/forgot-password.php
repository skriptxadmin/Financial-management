<?php echo $this->extend("layouts/basic") ?>

<?php echo $this->section('title') ?>
   Forgot Password Page
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>
<div class="container min-vh-100 d-flex justify-content-center align-items-center">
  <div class="row w-100">
    <div class="col-12 col-md-6 col-lg-4 mx-auto">

      <div class="card shadow-sm" style="border:none; border-radius:16px;">

        <!-- Header -->
        <div class="card-header bg-white text-center border-0" style="padding: 2rem 2rem 1rem; border-radius: 16px 16px 0 0 !important;">
          <div class="mx-auto mb-3 d-flex align-items-center justify-content-center bg-primary text-white" style="width:52px; height:52px; border-radius:14px;">
            <i class="bi bi-person-fill fs-4"></i>
          </div>
       <h5 class="fw-bold mb-1">Forgot Your Password?</h5>
<p class="text-muted small mb-0">Enter your email or username to reset your password</p>
        </div>

        <!-- Body -->
        <div class="card-body" style="padding: 1.5rem 2rem 2rem;">
          <form method="post" class="forgot-password">

            <!-- Username -->
            <div class="form-group mb-3">
              <label for="username" class="form-label fw-medium">Email / Username</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="username" name="username"
                  placeholder="Enter email or username" autocomplete="username">
              </div>
            </div>

            <!-- Submit -->
            <div class="d-grid">
              <button type="submit" class="btn btn-primary fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i> Reset Password
              </button>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
   <script src="<?php echo base_url('scripts/guest/forgot-password.js') ?>"></script>
<?php echo $this->endSection() ?>