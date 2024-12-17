<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental extends CI_Controller {
    function __construct(){  
        parent::__construct();

        if (empty($this->session->userdata('login'))) {
            redirect('Auth');
        }
        $this->load->model('m_user');
        $this->load->model('M_rental');
        // $this->load->helper('rental_helper'); // Memuat helper

    }

    public function index()
    {
        $data['rental'] = $this->M_rental->getAllRental();
        $data['playstation'] = $this->M_rental->getPlaystation();
        $data['user'] = $this->m_user->tampil_data()->result_array();

        $this->load->view('v_topbar', $data);
        $this->load->view('rental/v_rental', $data);
        $this->load->view('v_footer'); 
    }

    // public function HistoryRental()
    // {
    //     $data['rental'] = $this->M_rental->getAllRentalHistory();
    //     $data['playstation'] = $this->M_rental->getPlaystation();


    //     $this->load->view('v_topbar', $data);
    //     $this->load->view('historyrental/v_historyrental', $data);
    //     $this->load->view('v_footer'); 
    // }


    public function get_rental_ongoing() {
        $data['rental'] = $this->M_rental->getAllRentalNow();
        echo json_encode($data['rental']);
    }

//     public function update_rental_status()
// {
//     // Ambil daftar rental yang telah expired
//     $expired_rentals = $this->M_rental->get_expired_rentals();

//     if (empty($expired_rentals)) {
//         // Tidak ada rental kadaluarsa, cukup return tanpa aksi
//         return false;
//     }

//     $updated_count = 0; // Hitung jumlah rental yang berhasil diupdate

//     foreach ($expired_rentals as $rental) {
//         $update_result = $this->M_rental->update_status_rental($rental->id_rental, 'selesai');
//         if ($update_result) {
//             $updated_count++;
//         }
//     }

//     // Untuk tujuan debugging/logging
//     log_message('info', "{$updated_count} rentals have been updated to 'selesai'.");

//     // Return jumlah rental yang diupdate (untuk keperluan debugging/logging)
//     return $updated_count;
// }

    public function update_rental_status()
    {
        $expired_rentals = $this->M_rental->get_expired_rentals();

        if (empty($expired_rentals)) {
            return false;
        }

    $expired_ids = array_column($expired_rentals, 'id_rental'); // Ambil semua ID rental
    $updated_count = $this->M_rental->batch_update_status_rental($expired_ids, 'selesai');

    log_message('info', "{$updated_count} rentals have been batch-updated to 'selesai'.");
    return $updated_count;
}



public function insert_rental() {
    $id_playstation = $this->input->post('id_playstation');
    $durasi = floatval($this->input->post('durasi'));

    // Ambil harga dari tabel playstation berdasarkan id_playstation
    $this->load->model('M_rental'); // Pastikan model diload
    $harga_playstation = $this->M_rental->getHargaPlaystation($id_playstation);

    // Hitung total biaya
    $total_biaya = $durasi * $harga_playstation;

    $data = [
        'id_playstation' => $id_playstation,
        'waktu_mulai' => $this->input->post('waktu_mulai'),
        'durasi' => $durasi,
        'total_biaya' => $total_biaya,
        'status' => 'berlangsung'
    ];

    $this->M_rental->insert_data($data);
    $this->session->set_flashdata('success', 'Data berhasil ditambah');
    redirect('Rental');
}


public function update_rental() {
    $id_rental = $this->input->post('id_rental');
    $id_playstation = $this->input->post('id_playstation');
    $waktu_mulai = $this->input->post('waktu_mulai');
    $durasi = $this->input->post('durasi');
    $total_biaya = $this->input->post('total_biaya');

    // Validasi dan update data di database
    $data = [
        'waktu_mulai' => $waktu_mulai,
        'durasi' => $durasi,
        'total_biaya' => $total_biaya,
    ];
    $this->M_rental->update_data($id_rental, $data); // Sesuaikan nama model
    $this->session->set_flashdata('edit','data berhasil di update');
    redirect('Rental');
}


public function hapus_rental($id)
{
    $where = array('id_rental' => $id);
    $this->M_rental->hapus_data($where);
    $this->session->set_flashdata('delete','data berhasil di hapus');
    redirect('Rental');
}

public function calculate_duration($waktu_mulai, $waktu_berakhir) {
    $start_time = strtotime($waktu_mulai);
    $end_time = strtotime($waktu_berakhir);
    $duration = $end_time - $start_time; // Durasi dalam detik

    return gmdate("H:i:s", $duration); // Mengubah durasi ke format jam:menit:detik
}
public function getDurations() {
    $rental = $this->M_rental->getAllRental();
    $data = [];

    foreach ($rental as $r) {
        $data[] = [
            'nomor_unit' => $r->nomor_unit,
            'waktu_mulai' => $r->waktu_mulai,
            'waktu_berakhir' => $r->waktu_berakhir,
            'durasi' => $this->calculate_duration($r->waktu_mulai, $r->waktu_berakhir),
            'total_biaya' => $r->total_biaya,
            'status' => $r->status,
        ];
    }

    echo json_encode($data);
}
}

