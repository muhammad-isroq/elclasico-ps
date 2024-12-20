  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Playstation</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
          <li class="breadcrumb-item active">Playstation</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <?php if($this->session->flashdata('success')){ ?>
        <script type="text/javascript">
          Swal.fire({
            title: "Data Ditambahkan!",               
            icon: "success"
          });
        </script>
      <?php } else if($this->session->flashdata('edit')){  ?>

        <script type="text/javascript">
          Swal.fire({
            title: "Data Diubah!",                
            icon: "success"
          });
        </script>         

      <?php } else if($this->session->flashdata('delete')){  ?>

        <script type="text/javascript">
          Swal.fire({
            title: "Data Dihapus!",               
            icon: "success"
          });
        </script>
      <?php } ?>
      <div class="row row-md">

        <?php

        $this->load->view('v_sidebar');

        ?>

        <div class="col-lg">
          <div class="card">
           <div class="card-body">
            <h5 class="card-title">Playstation</h5>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="ri-folder-add-line"></i>
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Playstation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="<?=base_url('Playstation/insert_playstation'); ?>" enctype="multipart/form-data">
                      <div class="form-group mb-3">
                        <label for="">Nomor unit</label>
                        <input type="number" name="nomor_unit" class="form-control" required>
                      </div>
                      <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Tipe Konsol</label>
                        <select class="form-select" name="tipe_konsol" id="inputGroupSelect01">
                          <option selected>Choose</option>
                          <option value="PS3">PS3</option>
                          <option value="PS4">PS4</option>
                          <option value="PS5">PS5</option>
                        </select>
                      </div>
                      <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Status</label>
                        <select class="form-select" name="status" id="inputGroupSelect01">
                          <option selected>Choose</option>
                          <option value="TERSEDIA">TERSEDIA</option>
                          <option value="NONAKTIF">NONAKTIF</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                      </div>
                      <div class="form-group mb-3">
                        <label for="sound">Notifikasi (MP3)</label>
                        <input type="file" name="sound" class="form-control" accept=".mp3" required>
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
            <div class="table table-responsive">
              <table class="table table-hover">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nomor Unit</th>
                  <th scope="col">Tipe Konsol</th>
                  <th scope="col">Status</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Sound</th>
                  <th scope="col" colspan="2">aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($playstation as $r){ ?>
                  <tr>
                    <td class="text-center"><?= $no; ?></td>
                    <td class="text-center"><?= $r['nomor_unit'];?></td>
                    <td class="text-center"><?= $r['tipe_konsol'];?></td>
                    <td class="text-center"><?= $r['status'];?></td>
                    <td class="text-center">Rp. <?= $r['harga'];?></td>
                    <td>
                      <audio controls>
                        <source src="<?= $r['sound']; ?>" type="audio/mp3">
                          Your browser does not support the audio element.
                        </audio>
                      </td>

                      <td class="">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $r['id_playstation'];?>"><i class="ri-edit-2-fill"></i></button>
                        <div class="modal fade" id="exampleModal2<?php echo $r['id_playstation'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Playstation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="<?=base_url('Playstation/update_playstation'); ?>" enctype="multipart/form-data">
                                  <input type="hidden" name="id_playstation" value="<?= $r['id_playstation']; ?>"> 
                                  <div class="form-group mb-3">
                                    <label for="">Nomor unit</label>
                                    <input type="number" name="nomor_unit" class="form-control" value="<?= $r['nomor_unit']?>">
                                  </div>
                                  <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Tipe Konsol</label>
                                    <select class="form-select" name="tipe_konsol" value="<?= $r['tipe_konsol'];?>" id="inputGroupSelect01">
                                      <option selected><?= $r['tipe_konsol'];?></option>
                                      <option value="PS3">PS3</option>
                                      <option value="PS4">PS4</option>
                                      <option value="PS5">PS5</option>
                                    </select>
                                  </div>
                                  <div class="input-group mb-3">
                                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                                    <select class="form-select" name="status" value="<?= $r['status'];?>" id="inputGroupSelect01">
                                      <option selected><?= $r['status'];?></option>
                                      <option value="TERSEDIA">TERSEDIA</option>
                                      <option value="NONAKTIF">NONAKTIF</option>
                                    </select>
                                  </div>
                                  <div class="form-group mb-3">
                                    <label for="">Harga</label>
                                    <input type="number" name="harga" class="form-control" value="<?= $r['harga']?>">
                                  </div>
                                  <div class="form-group mb-3">
                                    <label for="sound">Notifikasi (MP3)</label>
                                    <input type="file" name="sound" class="form-control" accept=".mp3" value="<?= $r['sound']?>">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah file sound.</small>
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
                        onclick="confirmDelete('<?= base_url().'Playstation/hapus_playstation/'.$r['id_playstation']; ?>')" 
                        class="btn btn-danger">
                        <i class="ri-delete-bin-5-line"></i>
                      </a>


                    </td>
                  </tr>
                  <?php $no++; } ?>
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