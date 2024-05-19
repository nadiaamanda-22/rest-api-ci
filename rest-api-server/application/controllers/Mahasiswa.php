<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mhs_m');
    }

    public function index_get()
    {
        $id = $this->get('id');
        $mhs = $this->mhs_m->getData($id);

        if ($mhs) {
            $this->response([
                'status' => true,
                'data' => $mhs
            ], RestController::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Data not found!'
            ], RestController::HTTP_OK);
        }
    }

    public function index_post()
    {
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        if ($this->mhs_m->addData($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'Data added!'
            ], RestController::HTTP_CREATED);
        } else {
            $this->response([
                'status' => false,
                'message' => 'Failed added data!'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function  index_put()
    {
        $id = $this->put('id');
        $data = [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan')
        ];

        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => 'Please input id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->mhs_m->editData($id, $data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Data updated!'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data not found!'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => 'Please input id!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->mhs_m->delData($id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'Data deleted!'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Data not found!'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }

    public function search_get()
    {
        $nama = $this->get('nama');
        $getNama = $this->mhs_m->searchData($nama);

        if ($nama != null) {
            if ($getNama != null) {
                $this->response([
                    'status' => true,
                    'data' => $getNama
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'data' => $getNama
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }
}
