
<main id="main" class="main">

	<div class="pagetitle">
		<h1>Dashboard</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.html">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section dashboard">
		<div class="row">

			<?php

			$this->load->view('v_sidebar');

			?>

			<div class="col-lg">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">History Rental</h5>
					<!-- <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
						tambah
					</button>
				-->				</div>
				<div class="card-body">
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Rental</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form method="POST" action="<?= base_url('HistoryRental/insert_rental'); ?>" enctype="multipart/form-data">
										<input type="hidden" name="id_rental" id="id_rental">
										<div class="mb-3">
											<label for="id_playstation" class="form-label">Nomor Unit</label>
											<select name="id_playstation" id="id_playstation" class="form-control" required>
												<option value="" disabled selected>Pilih Unit</option>
												<?php foreach ($playstation as $b): ?>
													<option value="<?= $b->id_playstation ?>"><?= $b->nomor_unit ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group mb-3">
											<label for="">Waktu Mulai</label>
											<input type="datetime-local" name="waktu_mulai" class="form-control" required>
										</div>
										<div class="form-group mb-3">
											<label for="">Durasi</label>
											<input type="number" step="0.1" min="0.5" name="durasi" class="form-control" required>
										</div>
										<div class="form-group mb-3">
											<label for="">Total Biaya</label>
											<input type="number" name="total_biaya" class="form-control" required>
										</div>
              <!-- <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupSelect01">Status</label>
                <select class="form-select" name="status" id="inputGroupSelect01" required>
                  <option selected>Choose</option>
                  <option value="BERLANGSUNG">BERLANGSUNG</option>
                  <option value="SELESAI">SELESAI</option>
                  <option value="DIBATALKAN">DIBATALKAN</option>
                </select>
              </div> -->
              <div class="modal-footer">
              	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              	<button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="table table-responsive">
    	<table class="table table-hover datatable">
    		<thead class="text-center">
    			<tr>
    				<th scope="col">No</th>
    				<th scope="col">Nomor Unit</th>
    				<th scope="col">Tipe Konsol</th>
    				<th scope="col">Waktu Mulai</th>
    				<th scope="col">Durasi</th>
    				<th scope="col">Total Biaya</th>
    				<th scope="col">Status</th>
    				<th scope="col">Aksi</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php $no = 1; foreach($rental as $r): ?>
    			<tr>
    				<td><?= $no; ?></td>
    				<td><?= $r->nomor_unit; ?></td>
    				<td><?= $r->tipe_konsol; ?></td>
    				<td><?= $r->waktu_mulai; ?></td>
    				<td><?= $r->durasi; ?> jam</td>
    				<td>Rp. <?= $r->total_biaya; ?></td>
    				<td><?= $r->status; ?></td>
    				<td>
    					<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2<?= $r->id_rental ?>"><i class="ri-edit-2-fill"></i></button>
    					<div class="modal fade" id="exampleModal2<?= $r->id_rental ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    						<div class="modal-dialog">
    							<div class="modal-content">
    								<div class="modal-header">
    									<h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Rental</h1>
    									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    								</div>
    								<div class="modal-body">
    									<form method="POST" action="<?= base_url('HistoryRental/update_rental'); ?>" enctype="multipart/form-data">
    										<input type="hidden" name="id_rental" value="<?= $r->id_rental; ?>">
    										<div class="mb-3">
    											<label class="form-label">Nomor Unit</label>
    											<select name="id_playstation" class="form-control">
    												<option value="<?= $r->id_playstation ?>"><?= $r->nomor_unit ?></option>
    												<?php foreach ($playstation as $b): ?>
    													<option value="<?= $b->id_playstation ?>"><?= $b->nomor_unit ?></option>
    												<?php endforeach; ?>
    											</select>
    										</div>
    										<div class="form-group mb-3">
    											<label for="">Waktu Mulai</label>
    											<input type="datetime-local" name="waktu_mulai" class="form-control" value="<?= $r->waktu_mulai ?>">
    										</div>
    										<div class="form-group mb-3">
    											<label for="">Durasi</label>
    											<input type="number" step="0.1" min="0.5" name="durasi" class="form-control" value="<?= $r->durasi ?>">
    										</div>
    										<div class="form-group mb-3">
    											<label for="">Total Biaya</label>
    											<input type="number" name="total_biaya" class="form-control" value="<?= $r->total_biaya ?>">
    										</div>
    										<div class="input-group mb-3">
    											<label class="input-group-text" for="inputGroupSelect01">Status</label>
    											<select class="form-select" name="status" value="<?= $r->status ?>">
    												<option selected><?= $r->status;?></option>
    												<option value="BERLANGSUNG">BERLANGSUNG</option>
    												<option value="SELESAI">SELESAI</option>
    												<option value="DIBATALKAN">DIBATALKAN</option>
    											</select>
    										</div>
    										<div class="modal-footer">
    											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    											<button type="submit" class="btn btn-primary">Save changes</button>
    										</div>
    									</form>
    								</div>
    							</div>
    						</div>
    					</div>
    					<a href="javascript:void(0);" 
    					onclick="confirmDelete('<?= base_url().'HistoryRental/hapus_rental/'.$r->id_rental ?>')" 
    					class="btn btn-danger">
    					<i class="ri-delete-bin-5-line"></i>
    				</a>
    			</td>
    		</tr>
    		<?php $no++; endforeach; ?>
    	</tbody>
    </table>
  </div>

</div>
</div>
</div>


</div>
</section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
	<div class="copyright">
		&copy; Copyright <strong><span>elclasico.playstation</span></strong>. All Rights Reserved
	</div>
	<div class="credits">
		<!-- All the links in the footer should remain intact. -->
		<!-- You can delete the links only if you purchased the pro version. -->
		<!-- Licensing information: https://bootstrapmade.com/license/ -->
		<!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
	</div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script type="text/javascript">
	function confirmDelete(url) {
		Swal.fire({
			title: 'Yakin ingin menghapus data ini?',
			text: "Data yang sudah dihapus tidak bisa dikembalikan!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
        // Redirect to the deletion URL
				window.location.href = url;
			}
		})
	}
</script>

