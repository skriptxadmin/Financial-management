<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
User Roles Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">User Roles</h5>
            <button class="btn btn-primary btn-user-role-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="userRolesTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('user-roles/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/user-roles/list.js') ?>"></script>
   <script src="<?= base_url('scripts/user-roles/form.js') ?>"></script>
<?= $this->endSection() ?>