<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Items Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-start align-items-center">
            <a href="<?= base_url('items') ?>" class="btn"><?= svg('arrow_back') ?></a>
            <h5 class="card-title">Create Item</h5>
        </div>
    </div>
    <div class="card-body">
<?= $this->include('items/form/form') ?>

    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/items/form.js') ?>"></script>
<?= $this->endSection() ?>