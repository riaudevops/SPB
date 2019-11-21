<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message'); ?>
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
                                <th scope="col">Tanggal Meminjam</th>
                                <th scope="col">Batas Pengembalian</th>
                                <th scope="col">Buku Dipinjam</th>
                                <th scope="col">Denda</th>
                                <th scope="col">Status</th>
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
                                    <th schope="row" style="text-align: center;"><?= $nomor ?></th>

                                    <!-- <td style="text-align: center;"><?php // echo date('d F Y', strtotime($p['tanggal_peminjaman']))  
                                                                                ?></td> -->
                                    <td style="text-align: center;"><?= tgl_indo($p['tanggal_peminjaman'])  ?></td>
                                    <td style="text-align: center;"><?= $p['status'] == 0 ? tgl_indo(date('Y-m-d', strtotime($p['tanggal_peminjaman'] . ' + 7 days'))) : '-'  ?></td>
                                    <td style="text-align: center;"><?= $p['judul'] ?></td>

                                    <?php

                                        $date1 = strtotime(date('Y-m-d'));
                                        $date2 = strtotime(date('Y-m-d', strtotime($p['tanggal_peminjaman'] . ' + 7 days')));

                                        if ($date2 > $date1) {
                                            $days = 0;
                                            $denda = 0;
                                        } else {
                                            // Formulate the Difference between two dates
                                            $diff = abs($date1 - $date2);


                                            // To get the year divide the resultant date into
                                            // total seconds in a year (365*60*60*24)
                                            $years = floor($diff / (365 * 60 * 60 * 24));


                                            // To get the month, subtract it with years and
                                            // divide the resultant date into
                                            // total seconds in a month (30*60*60*24)
                                            $months = floor(($diff - $years * 365 * 60 * 60 * 24)
                                                / (30 * 60 * 60 * 24));


                                            // To get the day, subtract it with years and
                                            // months and divide the resultant date into
                                            // total seconds in a days (60*60*24)
                                            $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
                                                $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                                            $denda = (int) $days * 500;
                                        }

                                        ?>

                                    <td style="text-align: center;"><?= 'Rp. ' . $denda; ?></td>
                                    <td style="text-align: center;"><?= $p['status'] == 1 ? '<div class="btn btn-success text-white">Sudah Dikembalikan</div>' : '<div class="btn btn-warning text-white">Belum Dikembalikan</div>'  ?></td>

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