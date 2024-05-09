<?php

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model
{
    private $_client;
    private $_url;
    private $_auth;
    private $_key;

    public function __construct()
    {
        $this->_client = new Client();
        $this->_url = 'http://localhost/rest-api-ci/rest-api-server/anggota';
        $this->_auth = ['admin', '54321'];
        $this->_key = 'nanad';
    }

    public function getAllMahasiswa()
    {
        $respone = $this->_client->request('GET', $this->_url, [
            'auth' => $this->_auth,
            'query' => [
                'key' => $this->_key
            ]
        ]);

        $result = json_decode($respone->getBody()->getContents(), true);
        return $result['data'];
    }

    public function getMahasiswaById($id)
    {
        $response = $this->_client->request('GET', $this->_url, [
            'auth' => $this->_auth,
            'query' => [
                'key' => $this->_key,
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama_anggota" => $this->input->post('nama_anggota', true),
            "no_anggota" => $this->input->post('no_anggota', true),
            "jabatan" => $this->input->post('jabatan', true),
            "key" => $this->_key
        ];

        $response = $this->_client->request('POST', $this->_url, [
            'auth' => $this->_auth,
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function hapusDataMahasiswa($id)
    {
        $response = $this->_client->request('DELETE', $this->_url, [
            'auth' => $this->_auth,
            'form_params' => [
                'key' => $this->_key,
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama_anggota" => $this->input->post('nama_anggota', true),
            "no_anggota" => $this->input->post('no_anggota', true),
            "jabatan" => $this->input->post('jabatan', true),
            "key" => $this->_key,
            "id" => $this->input->post('id')
        ];


        $response = $this->_client->request('PUT', $this->_url, [
            'auth' => $this->_auth,
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
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
