<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Company Contact Status Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Company Contact Status</h5>
            <button class="btn btn-primary btn-company-contact-status-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="companyContactStatusTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('company-contact-status/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/company-contact-status/list.js') ?>"></script>
   <script src="<?= base_url('scripts/company-contact-status/form.js') ?>"></script>
<?= $this->endSection() ?>