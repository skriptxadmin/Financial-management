<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Items Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Items</h5>
            <a class="btn btn-primary" href="<?= base_url("items/create"); ?>">Create</a>
        </div>
    </div>
    <div class="card-body">
            <div class="table-responsive">
            <table id="itemsTable" class="table table-bordered"></table>
            </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/items/list.js') ?>"></script>
<?= $this->endSection() ?>