<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Warehouse Location Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-start align-items-center">
            <a href="<?= base_url('warehouse-locations') ?>" class="btn"><?= svg('arrow_back') ?></a>
            <h5 class="card-title">Create Warehouse Location</h5>
        </div>
    </div>
    <div class="card-body">
<?= $this->include('warehouse-locations/form/form') ?>

    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/warehouse-locations/form.js') ?>"></script>
<?= $this->endSection() ?>