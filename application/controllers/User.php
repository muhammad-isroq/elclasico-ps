<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();

		if (empty($this->session->userdata('login'))) {
			redirect('Auth');
		}

		$this->load->model('m_user');
		$this->load->library('upload'); // Tambahkan library upload
	}

	public function index() {
		$data['title'] = 'Manajemen Data User';

		$data['user'] = $this->m_user->tampil_data()->result_array();

		$this->load->view('v_header', $data);
		$this->load->view('user/v_user', $data);
		$this->load->view('v_footer');
	}


	public function insert_user() {
		$u = $this->input->POST('username');
		$p = md5($this->input->POST('password'));
		$n = $this->input->POST('nama_lengkap');

		// Konfigurasi upload foto
		$config['upload_path']   = './uploads/'; // Folder untuk menyimpan file
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 2048; // Ukuran maksimum 2MB

		$this->upload->initialize($config);

		// Inisialisasi foto kosong
		$foto = '';

		// Proses upload foto jika ada file yang dipilih
		if ($this->upload->do_upload('foto')) {
			$foto = $this->upload->data('file_name');
		}

		// Data yang akan disimpan
		$data = array(
			'username' => $u,
			'password' => $p,
			'nama_lengkap' => $n,
			'foto' => $foto
		);

		$this->m_user->insert_data($data);
		$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
		redirect('User');
	}


	public function update_user() {
		$id = $this->input->POST('id');
		$u = $this->input->POST('username');
		$p = $this->input->POST('password');
		$n = $this->input->POST('nama_lengkap');

		// Konfigurasi upload foto
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']      = 2048;

		$this->upload->initialize($config);

		// Jika foto baru diunggah
		$foto = null;
		if ($this->upload->do_upload('foto')) {
			$foto = $this->upload->data('file_name');
		}

		// Data yang akan diupdate
		$data = array(
			'username' => $u,
			'nama_lengkap' => $n
		);

		// Update password jika diisi
		if (!empty($p)) {
			$data['password'] = md5($p);
		}

		// Tambahkan foto ke data jika diunggah
		if ($foto) {
			$data['foto'] = $foto;
		}

		$where = array('id' => $id);
		$this->m_user->update_data($data, $where);
		$this->session->set_flashdata('edit', 'Data berhasil diupdate');
		redirect('User');
	}

	public function hapus_user($id) {
		// Hapus foto terlebih dahulu
		$user = $this->m_user->edit_data(['id' => $id])->row_array();
		if (!empty($user['foto']) && file_exists('./uploads/' . $user['foto'])) {
			unlink('./uploads/' . $user['foto']);
		}

		// Hapus data dari database
		$where = array('id' => $id);
		$this->m_user->hapus_data($where);
		$this->session->set_flashdata('delete', 'Data berhasil dihapus');
		redirect('User');
	}
}
