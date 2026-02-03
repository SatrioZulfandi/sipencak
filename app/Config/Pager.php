<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Pager extends BaseConfig
{
    public array $templates = [
        // Ubah default_full agar mengarah ke template Anda
        'default_full'   => 'App\Views\Pagers\papan_info_pager',
        'default_simple' => 'CodeIgniter\Pager\Views\default_simple',
        'default_head'   => 'CodeIgniter\Pager\Views\default_head',
        'papan_info_pager' => 'App\Views\Pagers\papan_info_pager',
    ];

    public int $perPage = 10;
    public int $surroundCount = 1; // Mengunci tampilan 1 kiri & 1 kanan dari halaman aktif
}
