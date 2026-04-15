<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
User Categories Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">User Categories</h5>
            <button class="btn btn-primary btn-user-category-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="userCategoriesTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('user-categories/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/user-categories/list.js') ?>"></script>
   <script src="<?= base_url('scripts/user-categories/form.js') ?>"></script>
<?= $this->endSection() ?>