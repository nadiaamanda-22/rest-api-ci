<?php
defined('BASEPATH') or exit('No direct script access allowed');

class anggota_model extends CI_Model
{
    public function getData()
    {
        return $this->db->get('anggota')->result_array();
    }
}
