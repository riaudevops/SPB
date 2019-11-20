<div class="container-fluid">

	<!-- Page Heading -->

	<div class="row">
		<div class="col">
			<?= $this->session->flashdata('message');?>
		</div>
	</div>
	<div class="row">
		<div class="col mb-2">
				<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					<i class="fas fa-fw fa-plus-circle"></i>
					Peminjaman Baru
				</button>
			<div class="collapse mt-2 mb-2" id="collapseExample">
				<div class="card card-body">
					Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-10">
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

						<?php $i = 0;$j = 0; $nomor = 0;foreach ($peminjaman as $p) {$nomor++; ?>
							<tr>
								<th schope="row" style="text-align: center;"><?= $nomor ?></th>

								<td style="text-align: center;"><?= $p['tanggal_peminjaman'] ?></td>
								<td style="text-align: center;"><?= $p['name'] ?></td>
								<td style="text-align: center;"><?= $p['judul'] ?></td>

								<?php

								$date1 = strtotime(date('Y-m-d'));
								$date2 = strtotime( date('Y-m-d', strtotime($p['tanggal_peminjaman']. ' + 7 days')) );

								if ($date2 > $date1){
									$days = 0;
									$denda = 0;
								}else{
									// Formulate the Difference between two dates
									$diff = abs($date1 - $date2);


									// To get the year divide the resultant date into
									// total seconds in a year (365*60*60*24)
									$years = floor($diff / (365*60*60*24));


									// To get the month, subtract it with years and
									// divide the resultant date into
									// total seconds in a month (30*60*60*24)
									$months = floor(($diff - $years * 365*60*60*24)
										/ (30*60*60*24));


									// To get the day, subtract it with years and
									// months and divide the resultant date into
									// total seconds in a days (60*60*24)
									$days = floor(($diff - $years * 365*60*60*24 -
											$months*30*60*60*24)/ (60*60*24));

									$denda = (int) $days * 500;
								}

								?>

								<td style="text-align: center;"><?= 'Rp. '.$denda; ?></td>

								<td style="text-align: center;">
									<a class="tombolHapusBuku btn btn-info" href="#" data-toggle="modal" data-target="#returnBookModal" data-id="<?= $p['id'] ?>"><i
											class="fas fa-undo"></i> Kembalikan</a>
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
