<?php echo $this->extend("layouts/app") ?>

<?php echo $this->section('title') ?>
Company Contacts Page
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">

            <?php if ($company): ?>
                <h5 class="card-title"><?php echo $company->name ?> Company Contacts</h5>
            <a class="btn btn-primary" href="<?php echo base_url("company-contacts/".$company->slug."/create"); ?>">Create</a>
            <?php endif; ?>
                <?php if (! $company): ?>
                <h5 class="card-title">All Company Contacts</h5>
              <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" data-company-slug="<?php echo $company?$company->slug:''; ?>">
            <table id="companyContactsTable"  class="table table-bordered"></table>
        </div>
    </div>
</div>
<?php echo $this->include('company-contacts/list/status'); ?>

<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>
<script src="<?php echo base_url('scripts/company-contacts/list.js') ?>"></script>
<script src="<?php echo base_url('scripts/company-contacts/status.js') ?>"></script>
<?php echo $this->endSection() ?>