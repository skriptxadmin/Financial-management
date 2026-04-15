<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Purchase Requests Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Purchase Requests</h5>
            <a class="btn btn-primary" href="<?= base_url("purchase-requests/create"); ?>">Create</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="purchaseRequestsTable" class="table table-bordered"></table>
        </div>
    </div>
</div>
<?= $this->include('purchase-requests/list/status'); ?>

<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
<script src="<?= base_url('scripts/purchase-requests/list.js') ?>"></script>
<script src="<?= base_url('scripts/purchase-requests/status.js') ?>"></script>
<?= $this->endSection() ?>