<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Warehouse Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-start align-items-center">
            <a href="<?= base_url('warehouses') ?>" class="btn"><?= svg('arrow_back') ?></a>
            <h5 class="card-title">Create Warehouse</h5>
        </div>
    </div>
    <div class="card-body">
<?= $this->include('warehouses/form/form') ?>

    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/warehouses/form.js') ?>"></script>
<?= $this->endSection() ?>