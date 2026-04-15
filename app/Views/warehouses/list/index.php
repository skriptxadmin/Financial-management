<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Warehouse Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Warehouses</h5>
            <a class="btn btn-primary" href="<?= base_url("warehouses/create"); ?>">Create</a>
        </div>
    </div>
    <div class="card-body">
            <div class="table-responsive">
            <table id="warehousesTable" class="table table-bordered"></table>
            </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/warehouses/list.js') ?>"></script>
<?= $this->endSection() ?>