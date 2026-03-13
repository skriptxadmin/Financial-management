<!DOCTYPE html>
<html lang="en">

<head>
                <?= $this->include('components/app-head.php'); ?>

</head>

<body style="overflow:hidden">

    <div class="container-fluid">
        <div class="row">
          <div class="col-12 p-0">
                <?= $this->include('components/navbar.php'); ?>

          </div>
        </div>
        <div class="row">
            <div class="col-lg-3 ps-0">
                <?= $this->include('components/offcanvas.php'); ?>
            </div>
        </div>
        <div class="col-lg-9" style="max-height:calc(100vh - 0px);overflow:auto;">
            <main >
                <?php echo $this->renderSection('content') ?>
            </main>
        </div>
    </div>




                <?= $this->include('components/app-foot.php'); ?>
   
   



</body>

</html>