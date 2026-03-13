<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Company Categories Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Company Categories</h5>
            <button class="btn btn-primary btn-company-category-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="companyCategoriesTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('company-categories/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/company-categories/list.js') ?>"></script>
   <script src="<?= base_url('scripts/company-categories/form.js') ?>"></script>
<?= $this->endSection() ?>