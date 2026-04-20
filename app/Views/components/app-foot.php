

                <?= $this->include('components/toast.php'); ?>
                <?= $this->include('components/loader.php'); ?>
                <?= $this->include('components/ratify.php'); ?>

    <script>
    appLocals = {
        base: "<?php echo base_url('') ?>",
        ajax: "<?php echo base_url('/ajax') ?>",
        user_id: "<?php echo session()->get('user')->id ?? 0 ?>",
        svgs:{
            edit: '<?= svg('edit'); ?>',
            delete: '<?= svg('delete'); ?>',
            contacts: '<?= svg('contacts'); ?>'
        }
    }
    </script>

    <script src="<?php echo base_url('node_modules/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?php echo base_url('node_modules/jquery-validation/dist/jquery.validate.min.js') ?>"></script>
    <script src="<?php echo base_url('node_modules/jquery-validation/dist/additional-methods.min.js') ?>"></script>
    <script src="<?php echo base_url('node_modules/lodash/lodash.min.js') ?>"></script>
    <script src="<?php echo base_url('node_modules/moment/min/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('node_modules/select2/dist/js/select2.min.js') ?>"></script>
    <script src="<?php echo base_url('node_modules/datatables.net/js/dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js') ?>"></script>

    
    <script src="<?php echo base_url('scripts/app.js') ?>"></script>
    <script src="<?php echo base_url('scripts/validate.js') ?>"></script>
    <script src="<?php echo base_url('scripts/toast.js') ?>"></script>
    <script src="<?php echo base_url('scripts/ajax.js') ?>"></script>
    <script src="<?php echo base_url('scripts/loader.js') ?>"></script>
    <script src="<?php echo base_url('scripts/ratify.js') ?>"></script>
   <?php if(session()->get('user')): ?>
    <script src="<?= base_url('scripts/user/logout.js') ?>"></script>
<?php endif; ?>
    <?php echo $this->renderSection('scripts') ?>