<?php

require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('anggota_model', 'am');
    }

    public function index_get()
    {
        $anggota = $this->am->getData();
        if ($anggota) {
            $this->response([
                'status' => true,
                'data' => $anggota
            ]);
        }
    }
}
