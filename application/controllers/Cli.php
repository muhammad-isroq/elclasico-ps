<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cli extends CI_Controller {
    public function update_rental_status()
    {
        if (php_sapi_name() !== 'cli') {
            show_error("This script can only be accessed via CLI.", 403);
        }

        $this->load->model('M_rental');
        $expired_rentals = $this->M_rental->get_expired_rentals();

        foreach ($expired_rentals as $rental) {
            $this->M_rental->update_status_rental($rental->id_rental, 'selesai');
        }

        echo "Status rental diperbarui.\n";
    }
}
