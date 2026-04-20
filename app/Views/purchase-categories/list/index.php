<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Purchase Categories Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Purchase Categories</h5>
            <button class="btn btn-primary btn-purchase-category-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="purchaseCategoriesTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('purchase-categories/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/purchase-categories/list.js') ?>"></script>
   <script src="<?= base_url('scripts/purchase-categories/form.js') ?>"></script>
<?= $this->endSection() ?>