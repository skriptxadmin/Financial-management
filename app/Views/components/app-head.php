    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo csrf_hash() ?>">
    <title><?php echo $this->renderSection('title') ?></title>
    <link rel="stylesheet" href="<?php echo base_url('node_modules/bootstrap/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('node_modules/bootstrap-icons/font/bootstrap-icons.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('node_modules/select2/dist/css/select2.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('styles/select2-bs5.css'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('styles/app.css') ?>">
    <?php echo $this->renderSection('styles') ?>