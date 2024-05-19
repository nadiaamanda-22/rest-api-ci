<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
    public function getData($id = null)
    {
        if ($id == null) {
            return $this->db->get('mahasiswa')->result_array();
        } else {
            return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
        }
    }

    public function addData($data)
    {
        $this->db->insert('mahasiswa', $data);
        return $this->db->affected_rows();
    }

    public function editData($id, $data)
    {
        $this->db->update('mahasiswa', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function delData($id)
    {
        $this->db->delete('mahasiswa', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
