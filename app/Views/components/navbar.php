<header>
    <nav class="navbar navbar-expand-lg bg-white">
  <div class="container-fluid">
    <div class="d-flex justify-content-start align-items-center">
 <button class="btn d-lg-none"
        data-bs-toggle="offcanvas"
        data-bs-target="#sidebar">
              <?= svg('menu') ?>

</button>
    <a class="navbar-brand" href="#">IIT Bombay</a>
    </div>
   
    <div>
      <ul class="navbar-nav ms-auto">
      
        <li class="nav-item">
          <a class="nav-link logout" data-href="<?php echo base_url('logout') ?>">
            <?= svg('logout') ?>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
</header>