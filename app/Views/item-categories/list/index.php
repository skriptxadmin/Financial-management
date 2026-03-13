<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Item Categories Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>    
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Item Categories</h5>
            <button class="btn btn-primary btn-item-category-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="itemCategoriesTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('item-categories/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/item-categories/list.js') ?>"></script>
   <script src="<?= base_url('scripts/item-categories/form.js') ?>"></script>
<?= $this->endSection() ?>