<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Warehouse Status Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Warehouse Status</h5>
            <button class="btn btn-primary btn-warehouse-status-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="warehouseStatusTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('warehouse-status/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/warehouse-status/list.js') ?>"></script>
   <script src="<?= base_url('scripts/warehouse-status/form.js') ?>"></script>
<?= $this->endSection() ?>