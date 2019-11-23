<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Dashboard Administrator</h1>

  <div class="row">
    <div class="col">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>

  <div class="row mt-2">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Buku Terdaftar</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_buku ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-book fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Pengguna Terdaftar</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_user ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user-circle fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Peminjaman</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_peminjaman ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-exchange-alt fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Pengembalian</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pengembalian ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-undo fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>


</div>
<!-- /.container-fluid -->

</div>