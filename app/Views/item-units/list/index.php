<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
 Item Units Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Item Units</h5>
            <button class="btn btn-primary btn-item-unit-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="itemUnitsTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('item-units/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/item-units/list.js') ?>"></script>
   <script src="<?= base_url('scripts/item-units/form.js') ?>"></script>
<?= $this->endSection() ?>