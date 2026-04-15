<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Urgency Levels Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Urgency Levels</h5>
            <button class="btn btn-primary btn-urgency-level-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="urgencyLevelsTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('urgency-levels/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/urgency-levels/list.js') ?>"></script>
   <script src="<?= base_url('scripts/urgency-levels/form.js') ?>"></script>
<?= $this->endSection() ?>