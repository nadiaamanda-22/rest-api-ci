<?php

class Mahasiswacrl_model extends CI_model
{

    private $_url;
    private $_key;
    private $_password;
    private $_username;

    public function __construct()
    {
        $this->_url = 'http://localhost/rest-api-ci/rest-api-server/mahasiswa';
        $this->_key = 'nanad';
        $this->_username = 'admin';
        $this->_password = 'admin';
    }

    public function getAllMahasiswa()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->_username:$this->_password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "key:$this->_key"
        ]);

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);
        return $response['data'];
    }

    public function tambahDataMahasiswa()
    {
        $data = http_build_query([
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true)
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->_username:$this->_password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Type-Content:application/x-www-form-urlencoded",
            "key:$this->_key"
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);
        return $response;
    }

    public function hapusDataMahasiswa($id)
    {

        $id = http_build_query([
            'id' => $id
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->_username:$this->_password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Type-Content:application/x-www-form-urlencoded",
            "key:$this->_key"
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $id);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result, true);
        return $response;
    }

    public function getMahasiswaById($id)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url . '?id=' . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->_username:$this->_password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "key:$this->_key"
        ]);
        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);
        return $response['data'][0];
    }

    public function ubahDataMahasiswa()
    {
        $data = http_build_query([
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id')
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->_username:$this->_password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Type-Content:application/x-www-form-urlencoded",
            "key:$this->_key"
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result, true);
        return $response;
    }

    public function cariDataMahasiswa($nama)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url . '/search?nama=' . $nama);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$this->_username:$this->_password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "key:$this->_key"
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($result, true);
        return $response['data'];
    }
}
