<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistoryRental extends CI_Controller {
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
        $data['rental'] = $this->M_rental->getAllRentalHistory();
        $data['playstation'] = $this->M_rental->getPlaystation();
        $data['user'] = $this->m_user->tampil_data()->result_array();

        $this->load->view('v_topbar', $data);
        $this->load->view('historyrental/v_historyrental', $data);
        $this->load->view('v_footer'); 
    }

    public function insert_rental() {
        $data = [
            'id_playstation' => $this->input->post('id_playstation'),
            'waktu_mulai' => $this->input->post('waktu_mulai'),
            'durasi' => floatval($this->input->post('durasi')),
            'total_biaya' => $this->input->post('total_biaya'),
            'status' => 'berlangsung'
        ];
    $this->M_rental->insert_data($data); // Sesuaikan nama model
    $this->session->set_flashdata('success','data berhasil di tambah');
    redirect('HistoryRental');
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
    redirect('HistoryRental');
}


public function hapus_rental($id)
{
    $where = array('id_rental' => $id);
    $this->M_rental->hapus_data($where);
    $this->session->set_flashdata('delete','data berhasil di hapus');
    redirect('HistoryRental');
}


}