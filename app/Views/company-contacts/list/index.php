<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Company Contacts Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Company Contacts</h5>
            <?php if($companySlug): ?>
            <a class="btn btn-primary" href="<?= base_url("company-contacts/".$companySlug."/create"); ?>">Create</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" data-company-slug="<?= $companySlug; ?>">
            <table id="companyContactsTable"  class="table table-bordered"></table>
        </div>
    </div>
</div>
<?= $this->include('company-contacts/list/status'); ?>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script src="<?= base_url('scripts/company-contacts/list.js') ?>"></script>
<script src="<?= base_url('scripts/company-contacts/status.js') ?>"></script>
<?= $this->endSection() ?>