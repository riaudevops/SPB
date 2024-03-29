<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion <?php if (!isset($_SESSION['username'])) echo "toggled" ?>" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-book-reader"></i>
		</div>
		<div class="sidebar-brand-text mx-3">SPB <sup>Online</sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">
	<?php if (isset($_SESSION['username'])) : ?>
		<?php if ($_SESSION['hak_akses'] == 1) { ?>

			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Home
			</div>

			<li class="nav-item <?php if ($index == 1) echo "active" ?>">
				<a class="nav-link" href="<?= base_url('home') ?>">
					<i class="fas fa-fw fa-chart-area"></i>
					<span>Dashboard</span></a>
			</li>

			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Buku
			</div>

			<li class="nav-item <?php if ($index == 2) echo "active" ?>">
				<a class="nav-link" href="<?= base_url('manage/book') ?>">
					<i class="fas fa-fw fa-book"></i>
					<span>Mengelola Buku</span></a>
			</li>

			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Pengguna
			</div>

			<li class="nav-item <?php if ($index == 3) echo "active" ?>">
				<a class="nav-link" href="<?= base_url('manage/user') ?>">
					<i class="fas fa-fw fa-user"></i>
					<span>Mengelola Data Pengguna</span></a>
			</li>

			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Peminjaman
			</div>

			<li class="nav-item <?php if ($index == 4) echo "active" ?>">
				<a class="nav-link" href="<?= base_url('manage/peminjaman') ?>">
					<i class="fas fa-fw fa-exchange-alt"></i>
					<span>Mengelola Data Peminjaman Buku</span></a>
			</li>

			<hr class="sidebar-divider">

			<div class="sidebar-heading">
				Pengembalian
			</div>

			<li class="nav-item <?php if ($index == 5) echo "active" ?>">
				<a class="nav-link" href="<?= base_url('history') ?>">
					<i class="fas fa-fw fa-clipboard"></i>
					<span>Cetak Riwayat Peminjaman</span></a>
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

		<?php } else if ($_SESSION['hak_akses'] == 0) { ?>

			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Home
			</div>

			<li class="nav-item <?php if ($index == 1) echo "active" ?>">
				<a class="nav-link" href="<?= base_url('home') ?>">
					<i class="fas fa-fw fa-chart-area"></i>
					<span>Dashboard</span></a>
			</li>

			<hr class="sidebar-divider">
			<div class="sidebar-heading">
				History
			</div>

			<li class="nav-item <?php if ($index == 2) echo "active" ?>">
				<a class="nav-link" href="<?= base_url('history') ?>">
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
	<?php else : ?>

		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('auth') ?>">
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