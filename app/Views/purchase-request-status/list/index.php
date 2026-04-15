<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Purchase Request Status Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Purchase Request  Status</h5>
            <button class="btn btn-primary btn-purchase-request-status-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="purchaseRequestStatusTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('purchase-request-status/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/purchase-request-status/list.js') ?>"></script>
   <script src="<?= base_url('scripts/purchase-request-status/form.js') ?>"></script>
<?= $this->endSection() ?>