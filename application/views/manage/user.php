<div class="container-fluid">

	<!-- Page Heading -->

	<div class="row">
		<div class="col">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<button type="button" class="btn btn-primary tambahUser" data-toggle="modal" data-target="#userModal">
				<i class="fas fa-fw fa-plus-circle"></i>
				Tambah User
			</button>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-6">
			<form action="http://localhost/SPB/manage/searchUser" method="post">
				<div class="input-group">
					<div class="input-group-prepend bg-light">
						<label class="input-group-text bg-light font-weight-light small" for="kategori">Cari User</label>
					</div>
					<input name="keywordNama" id="keywordNama" autocomplete="off" type="text" class="w-50 form-control" placeholder="Cari Nama User" required>
					<div class="input-group-append">
						<button class="btn btn-primary" type="submit" id="tombolCariUser">Cari</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="mt-2 row">
		<div class="col-6">
			<div class="card">
				<div class="table-responsive">

					<table class="table table-hover">
						<thead style="background: #4e73df;" class="text-light">
							<!-- judul	penulis	tahun	penerbit	kota_terbit	sub_judul	jumlah_halaman	letak_buku	jumlah -->
							<tr style="text-align: center;">
								<th scope="col">#</th>
								<th scope="col">Nama</th>
								<th scope="col">Nomor Keanggotaan</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>

							<?php $i = 0;
							foreach ($user as $u) {
								$i++; ?>
								<tr>
									<th schope="row"><?= $i ?></th>
									<td style="text-align: center;"><?= $u['name'] ?></td>
									<td style="text-align: center;"><?= $u['username'] ?></td>
									<td style="text-align: center;">
										<a class="ubahUser" href="#" data-toggle="modal" data-target="#userModal" data-id="<?= $u['id'] ?>"><i class="fas fa-edit"></i></a>
										<a class="tombolHapusUser" href="#" data-toggle="modal" data-target="#deleteUserModal" data-id="<?= $u['id'] ?>"><i class="fas fa-trash-alt"></i></a>
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
			<?= isset($pagination) ? $pagination : ''; ?>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>