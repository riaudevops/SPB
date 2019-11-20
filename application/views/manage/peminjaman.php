<div class="container-fluid">

	<!-- Page Heading -->

	<div class="row">
		<div class="col">
			<?= $this->session->flashdata('message');?>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<p>
				<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					Tambah Data Peminjaman
				</button>
			</p>
			<div class="collapse" id="collapseExample">
				<div class="card card-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
				</div>
			</div>
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
					<input name="keyword" id="keyword" autocomplete="off" type="text" class="w-50 form-control"
						   placeholder="Kata Kunci" required>
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
							<th scope="col">Tanggal Meminjam</th>
							<th scope="col">Peminjam</th>
							<th scope="col">Buku Dipinjam</th>
							<th scope="col">Action</th>
						</tr>
						</thead>
						<tbody>

						<?php $i = 0;$j = 0; $nomor = 0;foreach ($data_peminjaman as $p) {$nomor++; ?>
							<tr>
								<th schope="row"><?= $nomor ?></th>

								<?php
									if($p['id_user'] == $peminjaman[$i]['id_user']){ ?>
										<td><?= $peminjaman[$i]['tanggal_peminjaman'] ?></td>
								<?php }else{ ?>
										<td><?php $i++; echo $peminjaman[$i]['tanggal_peminjaman'] ?></td>
								<?php } ?>

								<?php
								if($p['id_user'] == $user_peminjam[$j]['id']){ ?>
									<td><?= $user_peminjam[$j]['name'] ?></td>
								<?php }else{ ?>
									<td><?php $j++; echo $user_peminjam[$j]['name'] ?></td>
								<?php } ?>

								<td><?php
									for ($x = 0; $x < count($buku_dipinjam); $x++){
										if($p['id_buku'] == $buku_dipinjam[$x]['id']){
											echo $buku_dipinjam[$x]['judul'];
										}
									}
									?></td>

								<td style="text-align: center;">
									<a class="ubahBuku" href="#" data-toggle="modal" data-target="#bookModal"
									   data-id="<?= 6 ?>"><i class="fas fa-edit"></i></a>
									<a class="tombolHapusBuku" href="#" data-toggle="modal" data-target="#deleteBookModal" data-id="<?= 8 ?>"><i
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
			<?= isset($pagination) ? $pagination : '' ; ?>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
