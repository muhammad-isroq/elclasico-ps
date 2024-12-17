<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playstation extends CI_Controller {
    function __construct(){  
        parent::__construct();
        if (empty($this->session->userdata('login'))) {
            redirect('Auth');
        }
        $this->load->model('m_user');
        $this->load->model('M_playstation');
    }

    public function index()
    {
        $data['playstation'] = $this->M_playstation->tampil_data()->result_array();
        $data['user'] = $this->m_user->tampil_data()->result_array();

        $this->load->view('v_topbar', $data);
        $this->load->view('playstation/v_playstation', $data);
        $this->load->view('v_footer'); 
    }

    public function laporan()
    {
        $data['playstation'] = $this->M_playstation->tampil_data()->result_array();

        $this->load->view('playstation/v_laporan', $data);
    }
    
    public function insert_playstation()
    {
        $z = $this->input->POST('nomor_unit');
        $x = $this->input->POST('tipe_konsol');
        $c = $this->input->POST('status');
        $v = $this->input->POST('harga');

        // Upload konfigurasi
        $config['upload_path'] = './uploads/sounds/';
        $config['allowed_types'] = 'mp3';
        $config['max_size'] = 2048; // Maksimal 2MB

        $this->load->library('upload', $config);

        // Proses upload file
        if (!$this->upload->do_upload('sound')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', 'Gagal mengunggah file: ' . $error);
            redirect('Playstation');
        } else {
            $uploadData = $this->upload->data();
            $filePath = 'uploads/sounds/' . $uploadData['file_name']; // Path file yang diupload

            // Data yang akan disimpan
            $data = array(
                'nomor_unit' => $z,
                'tipe_konsol' => $x,
                'status' => $c,
                'harga' => $v,
                'sound' => $filePath,
            );

            $this->M_playstation->insert_data($data);
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('Playstation');
        }
    }

    public function update_playstation()
    {
        $id = $this->input->POST('id_playstation');
        $z = $this->input->POST('nomor_unit');
        $x = $this->input->POST('tipe_konsol');
        $c = $this->input->POST('status');
        $v = $this->input->POST('harga');

        // Upload konfigurasi
        $config['upload_path'] = './uploads/sounds/';
        $config['allowed_types'] = 'mp3';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        $data = array(
            'nomor_unit' => $z,
            'tipe_konsol' => $x,
            'status' => $c,
            'harga' => $v,
        );

        // Cek apakah ada file baru yang diunggah
        if ($this->upload->do_upload('sound')) {
            $uploadData = $this->upload->data();
            $filePath = 'uploads/sounds/' . $uploadData['file_name'];
            $data['sound'] = $filePath; // Tambahkan path file baru ke dalam array data
        }

        $where = array('id_playstation' => $id);
        $this->M_playstation->update_data($data, $where);
        $this->session->set_flashdata('edit', 'Data berhasil diupdate');
        redirect('Playstation');   
    }

    public function hapus_playstation($id)
    {
        $where = array('id_playstation' => $id);
        $this->M_playstation->hapus_data($where);
        $this->session->set_flashdata('delete', 'Data berhasil dihapus');
        redirect('Playstation');
    }
}
