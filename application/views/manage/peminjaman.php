<?php
// Set timezone 
date_default_timezone_set('Asia/Jakarta');
?>
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Manajemen Peminjaman Buku</h1>

	<div class="row">
		<div class="col">
			<?= $this->session->flashdata('message'); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-10 mb-2">
			<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				<i class="fas fa-fw fa-plus-circle"></i>
				Peminjaman Baru
			</button>
			<div class="collapse mt-2 mb-2" id="collapseExample">
				<div class="card card-body">
					<form action="<?= base_url('manage/addPeminjaman') ?>" method="post">
						<div class="form-group row">
							<label for="tanggalPeminjaman" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
							<div class="col-sm-4">
								<input id="tanggalPeminjaman" name="tanggalPeminjaman" type="text" readonly class="form-control-plaintext" value="<?= tgl_indo(date('Y-m-d')) ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="CariNamaPeminjam" class="col-sm-3 col-form-label">Nama Peminjam</label>
							<div class="col-sm-3">
								<input id="CariNamaPeminjam" type="text" class="form-control" autocomplete="off" placeholder="Cari Nama Peminjam">
							</div>
							<div class="col">
								<select id="namaPeminjam" name="namaPeminjam" class="form-control">
									<option value="">Tidak ada data</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="CariBukuDipinjam" class="col-sm-3 col-form-label">Buku Dipinjam</label>
							<div class="col-sm-3">
								<input id="CariBukuDipinjam" type="text" class="form-control" autocomplete="off" placeholder="Cari Buku">
							</div>
							<div class="col">
								<select id="bukuDipinjam" name="bukuDipinjam" class="form-control">
									<option value=""> Tidak ada data</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<button id="submitPeminjaman" type="submit" class="float-right btn btn-info">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-10">
			<form action="http://localhost/SPB/manage/searchPeminjaman" method="post">
				<div class="input-group">
					<div class="input-group-prepend bg-light">
						<label class="input-group-text bg-light font-weight-light small" for="keyword">Cari
							Berdasarkan</label>
					</div>
					<input name="keyword" id="keyword" autocomplete="off" type="text" class="w-50 form-control" placeholder="Kata Kunci" required>
					<div class="input-group-append">
						<button class="btn btn-primary" type="submit" id="tombolCari">Cari</button>
					</div>
				</div>
			</form>
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
								<th scope="col">Peminjam</th>
								<th scope="col">Buku Dipinjam</th>
								<th scope="col">Denda</th>
								<th scope="col">Action</th>
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
									<td style="text-align: center;"><?= $p['name'] ?></td>
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

									<td class="teksDenda" style="text-align: center;"><?= 'Rp. ' . $denda; ?></td>

									<td style="text-align: center;">
										<button id="tombolKembalikan" class="tombolKembalikan btn btn-info" href="#" data-toggle="modal" data-target="#returnBookModal" data-id="<?= $id_peminjaman[$k++]['id'] ?>"><i class="fas fa-undo"></i> Kembalikan</button>
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