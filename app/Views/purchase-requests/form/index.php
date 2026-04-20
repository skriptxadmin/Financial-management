<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Purchase Requests Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-start align-items-center">
            <a href="<?= base_url('purchase-requests') ?>" class="btn"><?= svg('arrow_back') ?></a>
            <h5 class="card-title">Create Request</h5>
        </div>
    </div>
    <div class="card-body">
<?= $this->include('purchase-requests/form/form') ?>

    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/purchase-requests/form.js') ?>"></script>
   <script src="<?= base_url('scripts/purchase-requests/select2-company.js') ?>"></script>
   <script src="<?= base_url('scripts/purchase-requests/select2-company-contact.js') ?>"></script>
   <script src="<?= base_url('scripts/purchase-requests/select2-category.js') ?>"></script>
   <script src="<?= base_url('scripts/purchase-requests/table.js') ?>"></script>
<?= $this->endSection() ?>