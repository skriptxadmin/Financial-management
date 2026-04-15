<?= $this->extend("layouts/app") ?>

<?= $this->section('title') ?>
Quotation Status Page
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title">Quotation Status</h5>
            <button class="btn btn-primary btn-quotation-status-create">Create</button>
        </div>
    </div>
    <div class="card-body">
            <table id="quotationStatusTable" class="table table-bordered"></table>
    </div>
</div>
<?=  $this->include('quotation-status/form/index'); ?>
<?= $this->endSection() ?>


<?= $this->section('scripts') ?>
   <script src="<?= base_url('scripts/quotation-status/list.js') ?>"></script>
   <script src="<?= base_url('scripts/quotation-status/form.js') ?>"></script>
<?= $this->endSection() ?>