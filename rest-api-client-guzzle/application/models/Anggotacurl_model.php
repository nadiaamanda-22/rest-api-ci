<?php

class Anggotacurl_model extends CI_model
{
    private $_url;
    private $_pass;
    private $_user;
    private $_key;

    public function __construct()
    {
        $this->_url = 'http://localhost/rest-api-ci/rest-api-server/anggota';
        $this->_pass = '54321';
        $this->_user = 'admin';
        $this->_key = 'nanad';
    }

    public function getAllMahasiswa()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$this->_user:$this->_pass");
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "key:$this->_key"
        ]);
        $result = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($result, true);
        return $response['data'];
    }

    public function getMahasiswaById($id)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$this->_user:$this->_pass");
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "key:$this->_key",
            "id:$id"
        ]);
        $result = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($result, true);
        return $response['data'][0];
    }

    public function tambahDataMahasiswa()
    {
        $data = http_build_query([
            "nama_anggota" => $this->input->post('nama_anggota', true),
            "no_anggota" => $this->input->post('no_anggota', true),
            "jabatan" => $this->input->post('jabatan', true),
            "key" => $this->_key
        ]);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$this->_user:$this->_pass");
        curl_setopt($curl, CURLOPT_HEADER, [
            "Content-Type:application/x-www-form-urlencoded",
            "key:$this->_key"
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($result, true);
        return $response;
    }

    public function hapusDataMahasiswa($id)
    {
        $data = http_build_query([
            'id' => $id
        ]);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$this->_user:$this->_pass");
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type:application/www-x-form-urlencoded",
            "key:$this->_key"
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($result, true);
        return $response;
    }

    public function ubahDataMahasiswa()
    {
        $data = http_build_query([
            "nama_anggota" => $this->input->post('nama_anggota', true),
            "no_anggota" => $this->input->post('no_anggota', true),
            "jabatan" => $this->input->post('jabatan', true),
            "key" => $this->_key,
            "id" => $this->input->post('id')
        ]);


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "$this->_user:$this->_pass");
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type:application/x-www-form-urlencoded",
            "key:$this->_key"
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($result, true);
        return $response;
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}
