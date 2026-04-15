<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Invoice Status Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Invoice Status</h5>
            <button class="btn btn-primary btn-invoice-status-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="invoiceStatusTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('invoice-status/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/invoice-status/list.js') ?>"></script>
   <script src="<?= base_url('scripts/invoice-status/form.js') ?>"></script>
<?= $this->endSection() ?>