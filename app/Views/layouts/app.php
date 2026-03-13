<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->include('components/app-head.php'); ?>

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 p-0">
                <?= $this->include('components/navbar.php'); ?>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 p-0">
                <?= $this->include('components/offcanvas.php'); ?>
            </div>
            <div class="col-lg-10 main mt-3">
                <main>
                    <?php echo $this->renderSection('content') ?>
                </main>
            </div>
        </div>

    </div>




    <?= $this->include('components/app-foot.php'); ?>





</body>

</html>