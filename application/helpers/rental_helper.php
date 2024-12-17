<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('calculate_duration')) {
    function calculate_duration($waktu_mulai, $waktu_berakhir) {
        $start_time = strtotime($waktu_mulai);
        $end_time = strtotime($waktu_berakhir);
        $duration = $end_time - $start_time; // Durasi dalam detik

        return gmdate("H:i:s", $duration); // Mengubah durasi ke format jam:menit:detik
    }
}