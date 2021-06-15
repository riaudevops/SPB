<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Riwayat Peminjaman Buku</h1>

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-primary" href="<?= base_url('history/cetakLaporan') ?>">
                <i class="fas fa-file-alt"></i>
                Cetak Laporan
            </a>
        </div>
    </div>

    <div class="mt-2 row">
        <div class="col-10">
            <div class="card">
                <div class="table-responsive">

                    <table class="table table-hover">
                        <thead style="background: #4e73df;" class="text-light">
                            <!-- judul	penulis	tahun	penerbit	kota_terbit	sub_judul	jumlah_halaman	letak_buku	jumlah -->
                            <tr style="text-align: center;">
                                <th scope="col">#</th>
                                <th scope="col">Nama Peminjam</th>
                                <th scope="col">Tanggal Dipinjam</th>
                                <th scope="col">Tanggal Dikembalikan</th>
                                <th scope="col">Buku Dipinjam</th>
                                <th scope="col">Denda</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 0;
                            $j = 0;
                            $k = 0;
                            $nomor = 0;
                            foreach ($peminjaman as $p) {
                                $nomor++; ?>
                                <tr>
                                    <th schope="row" style="text-align: center;"><?= ($this->uri->segment(3)) ? $nomor + $this->uri->segment(3) : $nomor; ?></th>

                                    <!-- <td style="text-align: center;"><?php // echo date('d F Y', strtotime($p['tanggal_peminjaman']))  
                                                                            ?></td> -->
                                    <td style="text-align: center;"><?= $p['name'] ?></td>
                                    <td style="text-align: center;"><?= tgl_indo($p['tanggal_peminjaman'])  ?></td>
                                    <td style="text-align: center;"><?= tgl_indo($p['tanggal_pengembalian']) ?></td>
                                    <td style="text-align: center;"><?= $p['judul'] ?></td>

                                    <?php

                                    $date1 = strtotime(date('Y-m-d'));
                                    $date2 = strtotime(date('Y-m-d', strtotime($p['tanggal_peminjaman'] . ' + 7 days')));

                                    if ($date2 > $date1) {
                                        $denda = 0;
                                    } else {
                                        $now = time(); // or your date as well
                                        $your_date = strtotime(($p['tanggal_peminjaman'] . ' + 8 days'));
                                        $datediff = $now - $your_date;
                                        $denda = (int) (round($datediff / (60 * 60 * 24))) * 500;
                                    }

                                    ?>

                                    <td style="text-align: center;"><?= 'Rp. ' . $p['denda']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <!--Tampilkan pagination-->
            <?= isset($pagination) ? $pagination : ''; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>