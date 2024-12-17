<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rental extends CI_Model {


    public function getPlaystation() {
        return $this->db->get('playstation')->result();
    }

    public function getHargaPlaystation($id_playstation) {
        $this->db->select('harga');
        $this->db->where('id_playstation', $id_playstation);
    $query = $this->db->get('playstation'); // Ambil data dari tabel playstation
    $result = $query->row();
    return $result ? $result->harga : 0; // Kembalikan harga atau 0 jika tidak ditemukan
}


public function getAllRental() {
    $this->db->select('rental.*, playstation.nomor_unit, playstation.tipe_konsol, playstation.status');
    $this->db->from('rental');
    $this->db->join('playstation', 'rental.id_playstation = playstation.id_playstation');
    $this->db->where('rental.status', 'berlangsung');
    $this->db->where('playstation.status', 'TERSEDIA'); // Filter hanya status "berlangsung"
    $this->db->order_by('rental.waktu_mulai', 'DESC'); // Urutkan berdasarkan waktu mulai terbaru
    return $this->db->get()->result();
}


public function getAllRentalHistory() {
    $this->db->select('rental.*, playstation.nomor_unit, playstation.tipe_konsol');
    $this->db->from('rental');
    $this->db->join('playstation', 'rental.id_playstation = playstation.id_playstation');
    $this->db->order_by('rental.waktu_mulai', 'DESC');
    return $this->db->get()->result();
}

public function getAllRentalNow() {
    $this->db->select('rental.*, playstation.nomor_unit, playstation.tipe_konsol, playstation.sound');
    $this->db->from('rental');
    $this->db->join('playstation', 'rental.id_playstation = playstation.id_playstation');
    $this->db->where('rental.status', 'berlangsung');
    $this->db->where('NOW() BETWEEN rental.waktu_mulai AND ADDTIME(rental.waktu_mulai, SEC_TO_TIME(rental.durasi * 3600))');
    return $this->db->get()->result();
}


public function get_expired_rentals($limit = 100)
{
    $this->db->select('id_rental');
    $this->db->from('rental');
    $this->db->where('status', 'berlangsung');
    $this->db->where("ADDTIME(waktu_mulai, SEC_TO_TIME(durasi * 3600)) <= NOW()", null, false); // Bandingkan dengan waktu saat ini di MySQL
    $this->db->limit($limit);

    return $this->db->get()->result();
}

public function update_status_rental($rental_id, $status)
{
    $this->db->where('id_rental', $rental_id);
    $this->db->update('rental', ['status' => $status]);

    // Mengembalikan hasil query
    return $this->db->affected_rows() > 0; // True jika ada perubahan
}


public function batch_update_status_rental($expired_ids, $status)
{
    if (empty($expired_ids)) {
        return false; // Tidak ada ID yang diupdate
    }

    $this->db->where_in('id_rental', $expired_ids);
    $this->db->update('rental', ['status' => $status]);

    return $this->db->affected_rows(); // Kembalikan jumlah baris yang diperbarui
}




function insert_data($data){
    return $this->db->insert('rental', $data);
}

function edit_data($where){
    return $this->db->get_where('rental', $where);
}

public function update_data($id_rental, $data) {
    $this->db->where('id_rental', $id_rental);
    $this->db->update('rental', $data);
}


function hapus_data($where){
    $this->db->where($where);
    $this->db->delete('rental');

} 

}
