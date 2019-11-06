<div class="container-fluid">

    <!-- Page Heading -->

    <!-- Button trigger modal -->

    <div class="row">
        <div class="col">
            <?= $this->session->flashdata('message');?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-primary tambahBuku" data-toggle="modal" data-target="#bookModal">
                <i class="fas fa-fw fa-plus-circle"></i>
                Tambah Buku
            </button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <form action="http://localhost/SPB/manage/searchBook" method="post">
                <div class="input-group">
                    <div class="input-group-prepend bg-light">
                        <label class="input-group-text bg-light font-weight-light small" for="kategori">Cari
                            Berdasarkan</label>
                    </div>
                    <select name="kategori" id="kategori" style="width: 150px;" class="custom-select">
                        <option value="Judul">Judul</option>
                        <option value="Penulis">Penulis</option>
                    </select>
                    <input name="keyword" id="keyword" autocomplete="off" type="text" class="w-50 form-control"
                        placeholder="Kata Kunci">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="tombolCari">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-2 row">
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead style="background: #4e73df;" class="text-light">
                            <!-- judul	penulis	tahun	penerbit	kota_terbit	sub_judul	jumlah_halaman	letak_buku	jumlah -->
                            <tr style="text-align: center;">
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Tahun</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Kota</th>
                                <th scope="col">Sub Judul</th>
                                <th scope="col">Halaman</th>
                                <th scope="col">Letak</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $i = 0 ;foreach ($buku as $b) { $i++; ?>
                            <tr>
                                <th schope="row"><?= $i ?></th>
                                <td><?= $b['judul'] ?></td>
                                <td><?= $b['penulis'] ?></td>
                                <td><?= $b['tahun'] ?></td>
                                <td><?= $b['penerbit'] ?></td>
                                <td><?= $b['kota_terbit'] ?></td>
                                <td><?= $b['sub_judul'] ?></td>
                                <td style="text-align: center;"><?= $b['jumlah_halaman'] ?></td>
                                <td><?= $b['letak_buku'] ?></td>
                                <td style="text-align: center;"><?= $b['jumlah'] ?></td>
                                <td style="text-align: center;">
                                    <a class="ubahBuku" href="" data-toggle="modal" data-target="#bookModal"
                                        data-id="<?= $b['id'] ?>"><i class="fas fa-edit"></i></a>
                                    <a href="" data-toggle="modal" data-target="#deleteBookModal" data-id="<?= $b['id'] ?>"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
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
            <?php echo $pagination; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>