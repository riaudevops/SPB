<!-- Sidebar -->
<ul
  class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion <?php if(!isset($_SESSION['username'])) echo"toggled"?>"
  id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-book-reader"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SPB <sup>Online</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <?php if(isset($_SESSION['username'])) : ?>
  <?php if($_SESSION['hak_akses'] == 1){ ?>

  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Home
  </div>

  <li class="nav-item <?php if($index == 1) echo"active"?>">
    <a class="nav-link" href="<?= base_url('home') ?>">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Dashboard</span></a>
  </li>

  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Book
  </div>

  <li class="nav-item <?php if($index == 2) echo"active"?>">
    <a class="nav-link" href="<?= base_url('manage/book') ?>">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Manajemen Buku</span></a>
  </li>

  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    User
  </div>

  <li class="nav-item <?php if($index == 3) echo"active"?>">
    <a class="nav-link" href="<?= base_url('manage/user') ?>">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Manajemen User</span></a>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Account
  </div>

  <li class="nav-item">
    <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <?php } else if($_SESSION['hak_akses'] == 0){ ?>

  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Home
  </div>

  <li class="nav-item <?php if($index == 1) echo"active"?>">
    <a class="nav-link" href="home">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Dashboard</span></a>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    History
  </div>

  <li class="nav-item">
    <a class="nav-link" href="">
      <i class="fas fa-fw fa-history"></i>
      <span>Riwayat Peminjaman</span></a>
  </li>

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Account
  </div>

  <li class="nav-item">
    <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <?php } ?>
  <?php else: ?>

  <li class="nav-item">
    <a class="nav-link" href="auth">
      <i class="fas fa-fw fa-sign-in-alt"></i>
      <span>Login</span></a>
  </li>

  <?php endif ?>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->