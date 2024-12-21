
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
      <?php

      $this->load->view('v_sidebar');

      ?>
      <div class="container mx-auto">
        <div class="row">
          <div class="container mt-5">
            <h1>Jadwal Rental</h1>
            <div class="row" id="rental-cards">
              <!-- Cards akan di-render dengan JavaScript -->
            </div>
          </div>
        </div>
      </div>

      <div class="card">

        <div class="card-body">
          <h5 class="card-title">Rental Sekarang</h5>
          <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ri-folder-add-line"></i>
          </button>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Rental</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="<?= base_url('Rental/insert_rental'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_rental" id="id_rental">
                    <div class="mb-3">
                      <label for="id_playstation" class="form-label">Nomor Unit</label>
                      <select name="id_playstation" id="id_playstation" class="form-control" required>
                        <option value="" disabled selected>Pilih Unit</option>
                        <?php foreach ($playstation as $b): ?>
                          <?php if ($b->status == 'TERSEDIA'): ?>
                            <option value="<?= $b->id_playstation ?>"><?= $b->nomor_unit ?></option>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label for="">Waktu Mulai</label>
                      <input type="datetime-local" name="waktu_mulai" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                      <label for="">Durasi</label>
                      <select name="durasi" class="form-control" required>
                        <option value="0">Tidak Ditentukan</option>
                        <option value="0.5">0.5 jam</option>
                        <option value="1">1 jam</option>
                        <option value="2">2 jam</option>
                        <option value="3">3 jam</option>
                        <option value="4">4 jam</option>
                        <option value="5">5 jam</option>
                        <!-- Tambahkan opsi durasi lainnya sesuai kebutuhan -->
                      </select>
                    </div>
<!--                     <div class="form-group mb-3">
                      <label for="">Total Biaya</label>
                      <input type="number" name="total_biaya" class="form-control" required>
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
            <table class="table table-hover">
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
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2<?= $r->id_rental ?>">ubah</button>
                    <div class="modal fade" id="exampleModal2<?= $r->id_rental ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Rental</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="<?= base_url('Rental/update_rental'); ?>" enctype="multipart/form-data">
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
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a href="<?= base_url().'Rental/hapus_rental/'.$r->id_rental ?>" type="button" class="btn btn-danger " onclick="return confirm('Yakin ingin menghapus?');">hapus</a>
                  </td>
                  <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2<?= $r->id_rental ?>">ubah</button>
                    <a href="<?= base_url().'Rental/akhiri_rental/'.$r->id_rental ?>" type="button" class="btn btn-danger">Akhiri</a>
                    <div class="modal fade" id="exampleModal2<?= $r->id_rental ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <!-- Modal content -->
                    </div>
                  </td>
                </tr>
                <?php $no++; endforeach; ?>
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

  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script>

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

function startRealTimeCostCalculation(elementId, harga, startTime) {
    const timerElement = document.getElementById(elementId);
    if (!timerElement) {
        console.warn(`Element with ID ${elementId} not found. Cost calculation will not update.`);
        return; // Keluar dari fungsi jika elemen tidak ada
    }

    function updateCost() {
        const now = new Date();
        const elapsed = (now - new Date(startTime)) / (1000 * 60 * 60); // Hitung waktu yang telah berlalu dalam jam
        const totalBiaya = Math.max(0, Math.floor(elapsed * harga)); // Hitung total biaya

        // Update total biaya di elemen yang sesuai
        const totalBiayaElement = document.getElementById(`total-biaya-${elementId}`);
        if (totalBiayaElement) {
            totalBiayaElement.textContent = `Rp. ${totalBiaya}`;
        }
    }

    updateCost(); // Panggil sekali untuk menampilkan biaya awal
    setInterval(updateCost, 1000); // Update setiap detik
}

  function renderCards(rentals) {
    const container = document.getElementById('rental-cards');
    container.innerHTML = ''; // Reset card sebelumnya

    rentals.forEach(rental => {
        const now = new Date();
        const hargaSewa = rental.harga_sewa;
        let endTime;

        // Cek apakah durasi adalah null
        if (rental.durasi !== null) {
            endTime = new Date(new Date(rental.waktu_mulai).getTime() + rental.durasi * 60 * 60 * 1000);
        }

        // Render card
        const card = document.createElement('div');
        card.className = 'col-md-4 mb-4 mt-2';
        card.innerHTML = `
        <div class="card shadow">
        <div class="card-body">
        <h5 class="card-title">Tipe Konsol: ${rental.tipe_konsol}</h5>
        <p class="card-title">Unit: ${rental.nomor_unit}</p>
        <p>Waktu Mulai: ${rental.waktu_mulai}</p>
        <p>Durasi: <span id="timer-${rental.id_rental}">${rental.durasi === null ? 'Tidak Ditentukan' : 'Loading...'}</span></p>
        <p>Total Biaya: Rp. ${rental.total_biaya}</p>
        <p>Status: <strong>${rental.status}</strong></p>
        </div>
        </div>`;
        container.appendChild(card);

        // Start countdown atau count-up
        if (rental.durasi !== null) {
            startCountdown(`timer-${rental.id_rental}`, endTime, rental.nomor_unit, rental.tipe_konsol, rental.sound);
        } else {
            startCountUp(`timer-${rental.id_rental}`, rental.waktu_mulai);
        }
        
    });
}

  function startCountdown(elementId, endTime, nomorUnit, tipeKonsol, soundPath) {
    let alertShown = false;
    let audio = new Audio(soundPath); // Gunakan soundPath yang diberikan

    // Tambahkan offset waktu acak jika endTime sama
    const now = new Date();
    const randomOffset = Math.floor(Math.random() * 1000); // 0 - 999 ms acak
    endTime = new Date(endTime.getTime() + randomOffset); // Tambahkan offset acak ke endTime

    let timerInterval; // Deklarasikan timerInterval di sini

    function updateTimer() {
        const now = new Date();
        const remaining = endTime - now;

        const timerElement = document.getElementById(elementId);
        if (!timerElement) {
            console.warn(`Element with ID ${elementId} not found. Timer will not update.`);
            clearInterval(timerInterval); // Hentikan interval jika elemen tidak ada
            return; // Keluar dari fungsi jika elemen tidak ada
        }

        if (remaining > 0) {
            const hours = Math.floor((remaining % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
            const minutes = Math.floor((remaining % (60 * 60 * 1000)) / (60 * 1000));
            const seconds = Math.floor((remaining % (60 * 1000)) / 1000);

            timerElement.textContent = `${hours}h ${minutes}m ${seconds}s`;

            if (hours === 0 && minutes === 10 && !alertShown) {
                alertShown = true;

                // Play sound when the alert shows
                audio.play();

                // Show the alert using SweetAlert
                Swal.fire({
                    title: "Peringatan!",
                    text: `Waktu rental untuk Unit ${nomorUnit} (${tipeKonsol}) tinggal 10 menit!`,
                    icon: "warning",
                    confirmButtonText: "OK"
                });
            }
        } else {
            timerElement.textContent = "Selesai";
            clearInterval(timerInterval);

            // Hapus card dan perbarui tabel
            const card = timerElement.closest(".card");
            if (card) card.remove();

            fetchRentals(); // Refresh data untuk menyinkronkan tabel
        }
    }

    updateTimer();
    timerInterval = setInterval(updateTimer, 1000); // Inisialisasi timerInterval di sini
}

function startCountUp(elementId, startTime) {
    const timerElement = document.getElementById(elementId);
    if (!timerElement) {
        console.warn(`Element with ID ${elementId} not found. Count-up will not update.`);
        return; // Keluar dari fungsi jika elemen tidak ada
    }

    function updateCountUp() {
        const now = new Date();
        const elapsed = now - new Date(startTime); // Hitung waktu yang telah berlalu dalam milidetik

        const hours = Math.floor((elapsed % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
        const minutes = Math.floor((elapsed % (60 * 60 * 1000)) / (60 * 1000));
        const seconds = Math.floor((elapsed % (60 * 1000)) / 1000);

        timerElement.textContent = `${hours}h ${minutes}m ${seconds}s`;
    }

    updateCountUp(); // Panggil sekali untuk menampilkan waktu awal
    setInterval(updateCountUp, 1000); // Update setiap detik
}


function updateTable(rentals) {
  $(document).on("click", ".btn-warning", function () {
    const rentalId = $(this).closest("tr").find("td:first").text();
    $("#exampleModal2" + rentalId).modal("show");
  });
  const tableBody = $("table tbody");
    tableBody.empty(); // Hapus semua baris sebelum render ulang

    rentals.forEach(rental => {
      const row = `
<tr>
<td>${rental.id_rental}</td>
<td>${rental.nomor_unit}</td>
<td>${rental.tipe_konsol}</td>
<td>${rental.waktu_mulai}</td>
<td>${rental.durasi === null ? 'Tidak Ditentukan' : rental.durasi + ' jam'}</td>
<td>Rp. ${rental.total_biaya}</td>
<td>${rental.status}</td>
<td>
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal2${rental.id_rental}"><i class="ri-edit-2-fill"></i></button>
<a href="javascript:void(0);" 
onclick="confirmDelete('<?= base_url().'Rental/hapus_rental/' ?>${rental.id_rental}')" 
class="btn btn-danger">
<i class="ri-delete-bin-5-line"></i>
</a>
<a href="<?= base_url().'Rental/akhiri_rental/'.$r->id_rental ?>" type="button" class="btn btn-danger">Akhiri</a>
<div class="modal fade" id="exampleModal2${rental.id_rental}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Rental</h1>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form method="POST" action="<?= base_url('Rental/update_rental') ?>">
<input type="hidden" name="id_rental" value="${rental.id_rental}">
<div class="mb-3">
<label class="form-label">Nomor Unit</label>
<select name="id_playstation" class="form-control">
<option value="${rental.id_playstation}">${rental.nomor_unit}</option>
</select>
</div>
<div class="form-group mb-3">
<label for="">Waktu Mulai</label>
<input type="datetime-local" name="waktu_mulai" class="form-control" value="${rental.waktu_mulai}">
</div>
<div class="form-group mb-3">
<label for="">Durasi</label>
<input type="number" step="0.1" min="0.5" name="durasi" class="form-control" value="${rental.durasi !== null ? rental.durasi : ''}">
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
</td>
</tr>
`;
tableBody.append(row);
    });
  }






        // Fetch data dari server
  function fetchRentals() {
    $.ajax({
      url: '<?= base_url("rental/get_rental_ongoing") ?>',
      method: 'GET',
      success: function (data) {
        const rentals = JSON.parse(data);
        renderCards(rentals);
        updateTable(rentals);
      }
    });
  }

  function updateRentalStatus(rentalId) {
    if (rentalId) {
        console.error("Rental ID is missing"); // Log jika ID tidak ada
        return; // Keluar dari fungsi jika ID tidak valid
      }

      $.ajax({
        url: '<?= base_url("rental/update_rental_status") ?>',
        method: 'POST',
        data: { rental_id: rentalId },
        success: function (response) {
          console.log("Response:", response);
        },
        error: function (xhr, status, error) {
          console.error("Error:", error);
          console.error("Response:", xhr.responseText);
        }
      });
    }


        // Load data saat halaman dibuka
    fetchRentals();
    updateRentalStatus();
        setInterval(fetchRentals, 60000); // Refresh setiap menit    
        // Perbarui status rental setiap 60 detik
        setInterval(updateRentalStatus, 60000);    

        // document.querySelector('form').addEventListener('submit', function(e) {
        //   const durasi = parseFloat(document.querySelector('input[name="durasi"]').value);
        //   if (isNaN(durasi) || durasi < 0.5) {
        //     alert("Durasi harus minimal 0.5 jam");
        //     e.preventDefault();
        //   }
        // });

      </script>
