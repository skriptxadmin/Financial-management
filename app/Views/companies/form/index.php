<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Company Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-start align-items-center">
            <a href="<?= base_url('companies') ?>" class="btn"><?= svg('arrow_back') ?></a>
            <h5 class="card-title">Create company</h5>
        </div>
    </div>
    <div class="card-body">
<?= $this->include('companies/form/form') ?>

    </div>
</div>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/companies/form.js') ?>"></script>
<?= $this->endSection() ?>