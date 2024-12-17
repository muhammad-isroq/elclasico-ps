<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_playstation extends CI_Model {

    function tampil_data(){
       return $this->db->get('playstation');
    }

    function insert_data($data){
        return $this->db->insert('playstation', $data);
    }

    function edit_data($where){
        return $this->db->get_where('playstation', $where);
    }

    function update_data($data, $where){
        $this->db->where($where);
        $this->db->update('playstation', $data);

    }

    function hapus_data($where){
        $this->db->where($where);
        $this->db->delete('playstation');

    } 
        
}
