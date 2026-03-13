<div class="offcanvas offcanvas-lg offcanvas-start d-lg-block bg-app-primary" tabindex="-1" id="sidebar">

    <div class="offcanvas-header d-lg-none">
        <h5 class="offcanvas-title text-white">Menu</h5>
        <button type="button" class="btn" data-bs-dismiss="offcanvas">
            <?= svg('close-white') ?>
        </button>
    </div>

    <div class="offcanvas-body">
        <ul class="nav flex-column w-100">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('users') ?>">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('user-roles') ?>">UserRoles</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('company-categories') ?>">Company Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('company-status') ?>">Company Status</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('company-contact-status') ?>">Company Contact Status</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('companies') ?>">Companies</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('company-contacts') ?>">Company Contacts</a></li>
 	    <li class="nav-item"><a class="nav-link" href="<?= base_url('item-categories') ?>">Item Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
        </ul>
    </div>
</div>