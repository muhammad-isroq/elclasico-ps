  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
          <li class="breadcrumb-item active">Admin</li>
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
            <h5 class="card-title">Admin</h5>
            <!-- <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="ri-folder-add-line"></i>
            </button> -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="<?=base_url('User/insert_user'); ?>" enctype="multipart/form-data">
                      <div class="form-group mb-3">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" required>
                      </div>
                      <div class="form-group mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" required>
                      </div>
                      <div class="form-group mb-3">
                        <label for="">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                      </div>
                      <div class="form-group mb-3">
                        <label for="">Foto</label>
                        <input type="file" name="foto" class="form-control" required>
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
            <table class="table table-hover">
              <thead class="text-center">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Username</th>
                  <th scope="col">Nama Lengkap</th>
                  <th scope="col">Foto</th>
                  <th scope="col" colspan="2">aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($user as $r){ ?>
                  <tr>
                    <td class="text-center"><?= $no; ?></td>
                    <td class="text-center"><?= $r['username'];?></td>
                    <td class="text-center"><?= $r['nama_lengkap'];?></td>
                    <td class="text-center">
                      <img src="<?= base_url() . '/uploads/' . $r['foto']?>" alt="" width="100">
                    </td>

                    <td class="">
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2<?php echo $r['id'];?>"><i class="ri-edit-2-fill"></i></button>
                      <div class="modal fade" id="exampleModal2<?php echo $r['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah User</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="<?=base_url('User/update_user'); ?>" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $r['id']; ?>"> 
                                <div class="form-group mb-3">
                                  <label for="">Username</label>
                                  <input type="text" name="username" class="form-control" value="<?= $r['username']?>">
                                </div>
                                <div class="form-group mb-3">
                                  <label for="">Password</label>
                                  <input type="password" name="password" class="form-control" value="<?= $r['password']?>">
                                </div>
                                <div class="form-group mb-3">
                                  <label for="">Nama Langkap</label>
                                  <input type="text" name="nama_lengkap" class="form-control" value="<?= $r['nama_lengkap']?>">
                                </div>
                                <div class="form-group mb-3">
                                  <label for="">Foto</label>
                                  <input type="file" name="foto" class="form-control" value="<?= $r['foto']?>">
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
                      <!-- <a href="<?=base_url().'User/hapus_user/'.$r['id']; ?>" type="button" class="btn btn-danger"><i class="ri-delete-bin-5-line"></i></a> -->

                    </td>
                  </tr>
                  <?php $no++; } ?>
                </tbody>
              </table>
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
