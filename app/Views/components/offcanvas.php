<div class="offcanvas offcanvas-lg offcanvas-start d-lg-block bg-app-primary" tabindex="-1" id="sidebar">

    <div class="offcanvas-header d-lg-none">
        <h5 class="offcanvas-title text-white">Menu</h5>
        <button type="button" class="btn" data-bs-dismiss="offcanvas">
            <?php echo svg('close-white') ?>
        </button>
    </div>

    <div class="offcanvas-body">
        <div class="nav-wrapper w-100">
          <ul class="nav flex-column w-100">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('dashboard') ?>">Dashboard</a>
    </li>

    <!-- USERS MENU -->
    <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center"
           data-bs-toggle="collapse" href="#usersMenu" role="button">
            Users
            <span>+</span>
        </a>

        <ul class="collapse ps-3" id="usersMenu">
            <li><a class="nav-link" href="<?php echo base_url('users') ?>">All Users</a></li>
            <li><a class="nav-link" href="<?php echo base_url('user-roles') ?>">User Roles</a></li>
            <li><a class="nav-link" href="<?php echo base_url('user-categories') ?>">User Categories</a></li>
        </ul>
    </li>

    <!-- COMPANIES MENU -->
    <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center"
           data-bs-toggle="collapse" href="#companyMenu" role="button">
            Companies
            <span>+</span>
        </a>

        <ul class="collapse ps-3" id="companyMenu">
            <li><a class="nav-link" href="<?php echo base_url('companies') ?>">All Companies</a></li>
            <li><a class="nav-link" href="<?php echo base_url('company-categories') ?>">Categories</a></li>
            <li><a class="nav-link" href="<?php echo base_url('company-status') ?>">Status</a></li>
            <li><a class="nav-link" href="<?php echo base_url('company-contact-status') ?>">Contact Status</a></li>
        </ul>
    </li>

    <!-- ITEMS MENU -->
    <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center"
           data-bs-toggle="collapse" href="#itemsMenu" role="button">
            Items
            <span>+</span>
        </a>

        <ul class="collapse ps-3" id="itemsMenu">
            <li><a class="nav-link" href="<?php echo base_url('items') ?>">All Items</a></li>
            <li><a class="nav-link" href="<?php echo base_url('item-categories') ?>">Categories</a></li>
            <li><a class="nav-link" href="<?php echo base_url('item-units') ?>">Units</a></li>
        </ul>
    </li>

     <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center"
           data-bs-toggle="collapse" href="#warehousesMenu" role="button">
            Warehouse
            <span>+</span>
        </a>

        <ul class="collapse ps-3" id="warehousesMenu">
            <li><a class="nav-link" href="<?php echo base_url('warehouses') ?>">All Warehouses</a></li>
            <li><a class="nav-link" href="<?php echo base_url('warehouse-status') ?>">Status</a></li>
	    <li><a class="nav-link" href="<?= base_url('warehouse-locations') ?>">Warehouse Locations</a></li>
        </ul>
    </li>

     <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center"
           data-bs-toggle="collapse" href="#purchaseRequestsMenu" role="button">
            Purchase Requests
            <span>+</span>
        </a>

        <ul class="collapse ps-3" id="purchaseRequestsMenu">
            <li><a class="nav-link" href="<?php echo base_url('purchase-requests') ?>">All Purchase Requests</a></li>
            <li><a class="nav-link" href="<?php echo base_url('purchase-request-status') ?>">Status</a></li>
	     </ul>
    </li>

       <li class="nav-item">
        <a class="nav-link d-flex justify-content-between align-items-center"
           data-bs-toggle="collapse" href="#othersMenu" role="button">
            Others
            <span>+</span>
        </a>

        <ul class="collapse ps-3" id="othersMenu">
            <li><a class="nav-link" href="<?php echo base_url('urgency-levels') ?>">Urgency Level</a></li>
            <li><a class="nav-link" href="<?php echo base_url('invoices') ?>">Invoices</a></li>
	    <li><a class="nav-link" href="<?php echo base_url('invoice-status') ?>">Invoice Status</a></li>
	    <li><a class="nav-link" href="<?php echo base_url('quotation-status') ?>">Quotation Status</a></li>
          </ul>
    </li>

</ul>
        </div>

    </div>
</div>