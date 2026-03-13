<?php echo $this->extend("layouts/app") ?>

<?php echo $this->section('title') ?>
Company Contact Page
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-start align-items-center">
            <a href="<?php echo base_url('company-contacts/'.$companySlug) ?>" class="btn"><?php echo svg('arrow_back') ?></a>
            <h5 class="card-title">Create contact</h5>
        </div>
    </div>
    <div class="card-body">
<?php echo $this->include('company-contacts/form/form') ?>

    </div>
</div>
<?php echo $this->endSection() ?>


<?php echo $this->section('scripts') ?>
   <script src="<?php echo base_url('scripts/company-contacts/form.js') ?>"></script>
<?php echo $this->endSection() ?>