<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sistem Peminjaman Buku Online <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Modal Add / Edit Book -->
<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalLabel">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('manage/addBook'); ?>" method="POST" autcomplete="OFF">
                <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <input autocomplete="off" name="judul" type="text" class="form-control" id="judul" placeholder="Judul"
                                required>
                            <?= form_error('judul', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                        <div class="col-sm-9">
                            <input autocomplete="off" name="penulis" type="text" class="form-control" id="penulis" placeholder="Penulis"
                                autcomplete="off">
                            <?= form_error('penulis', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                        <div class="col-sm-9">
                            <input autocomplete="off" name="tahun" type="number" class="form-control" id="tahun" placeholder="Tahun">
                            <?= form_error('tahun', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penerbit" class="col-sm-3 col-form-label">Penerbit</label>
                        <div class="col-sm-9">
                            <input autocomplete="off" name="penerbit" type="text" class="form-control" id="penerbit"
                                placeholder="Penerbit">
                            <?= form_error('penerbit', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kota_terbit" class="col-sm-3 col-form-label">Kota Terbit</label>
                        <div class="col-sm-9">
                            <input autocomplete="off" name="kota_terbit" type="text" class="form-control" id="kota_terbit"
                                placeholder="Kota Terbit">
                            <?= form_error('kota_terbit', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sub_judul" class="col-sm-3 col-form-label">Sub Judul</label>
                        <div class="col-sm-9">
                            <textarea name="sub_judul" class="form-control" id="sub_judul" rows="2"></textarea>
                            <?= form_error('sub_judul', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_halaman" class="col-sm-3 col-form-label">Jumlah Halaman</label>
                        <div class="col-sm-9">
                            <input autocomplete="off" name="jumlah_halaman" type="number" class="form-control" id="jumlah_halaman"
                                placeholder="Jumlah Halaman">
                            <?= form_error('jumlah_halaman', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="letak_buku" class="col-sm-3 col-form-label">Letak Buku</label>
                        <div class="col-sm-9">
                            <input autocomplete="off" name="letak_buku" type="text" class="form-control" id="letak_buku"
                                placeholder="Letak Buku">
                            <?= form_error('letak_buku', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-sm-3 col-form-label">Jumlah Buku</label>
                        <div class="col-sm-9">
                            <input autocomplete="off" name="jumlah" type="number" class="form-control" id="jumlah"
                                placeholder="Jumlah Buku">
                            <?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <button id="submitButton" type="submit" class="btn btn-primary btn-user btn-block">
                        Submit
                    </button>
                    <button class="btn btn-normal btn-user btn-block" data-dismiss="modal">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Book Modal-->
<div class="modal fade" id="deleteBookModal" tabindex="-1" role="dialog" aria-labelledby="deleteBookModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin ingin hapus data buku?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Harap perhatikan bahwa buku yang dihapus tidak akan dapat dikembalikan.</div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal">Cancel</button>
                <a class="hapusBuku btn btn-danger" href="">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keluar dari sistem?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih Logout untuk mengakhiri session dan keluar dari sistem</div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<!-- <script src="<?php // base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/script.js"></script>

<script>
</script>

</body>

</html>