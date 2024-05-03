<?php
defined('BASEPATH') or exit('No direct script access allowed');

class anggota_model extends CI_Model
{
    public function getData($id = null)
    {
        if ($id == null) {
            return $this->db->get('anggota')->result_array();
        } else {
            return $this->db->get_where('anggota', ['id' => $id])->result_array();
        }
    }

    public function addData($data)
    {
        $this->db->insert('anggota', $data);
        return $this->db->affected_rows();
    }

    public function editData($id, $data)
    {
        $this->db->update('anggota', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function delData($id)
    {
        $this->db->delete('anggota', ['id' => $id]);
        return $this->db->affected_rows();
    }
}
