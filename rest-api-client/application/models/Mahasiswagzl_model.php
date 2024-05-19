<?php

use GuzzleHttp\Client;

class Mahasiswagzl_model extends CI_model
{

    private $_client;
    private $_key;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost/rest-api-ci/rest-api-server/',
            'auth' => ['admin', 'admin']
        ]);
        $this->_key = 'nanad';
    }

    public function getAllMahasiswa()
    {
        $response = $this->_client->request('GET', 'mahasiswa', [
            'query' => [
                'key' => $this->_key
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "key" => $this->_key
        ];

        $response = $this->_client->request('POST', 'mahasiswa', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function hapusDataMahasiswa($id)
    {
        $response = $this->_client->request('DELETE', 'mahasiswa', [
            'form_params' => [
                'key' => $this->_key,
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function getMahasiswaById($id)
    {
        $response = $this->_client->request('GET', 'mahasiswa', [
            'query' => [
                'key' => $this->_key,
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id'),
            "key" => $this->_key
        ];

        $response = $this->_client->request('PUT', 'mahasiswa', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataMahasiswa($nama)
    {
        $data = [
            "nama" => $nama,
            "key" => $this->_key
        ];


        $response = $this->_client->request('GET', 'mahasiswa/search', [
            'query' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }
}
