<?php

if (!function_exists('tanggal_indonesia')) {
    function tanggal_indonesia($tanggal)
    {
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $tanggal = date('Y-m-d', strtotime($tanggal)); // pastikan format konsisten
        $parts = explode('-', $tanggal); // [YYYY, MM, DD]

        return $parts[2] . ' ' . $bulan[(int)$parts[1]] . ' ' . $parts[0];
    }
}