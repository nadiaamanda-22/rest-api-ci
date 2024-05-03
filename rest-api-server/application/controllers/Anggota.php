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
        $id = $this->get('id');
        $anggota = $this->am->getData($id);

        if ($id != null) {
            if ($anggota != null) {
                $this->response([
                    'status' => true,
                    'data' => $anggota
                ], RestController::HTTP_OK);
            } else if ($anggota == null) {
                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], RestController::HTTP_NOT_FOUND);
            }
        } else {
            $this->response([
                'status' => true,
                'data' => $anggota
            ], RestController::HTTP_OK);
        }
    }

    public function index_post()
    {
        $data = [
            'no_anggota' => $this->post('no_anggota'),
            'nama_anggota' => $this->post('nama_anggota'),
            'jabatan' => $this->post('jabatan')
        ];

        if ($this->am->addData($data) > 0) {
            $this->response([
                'status' => true,
                'message' => 'data added!'
            ], RestController::HTTP_OK);
        }
    }

    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'no_anggota' => $this->put('no_anggota'),
            'nama_anggota' => $this->put('nama_anggota'),
            'jabatan' => $this->put('jabatan')
        ];

        if ($id == null) {
            $this->response([
                'status' => false,
                'message' => 'ID unknow!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->am->editData($id, $data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'updated data!'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
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
                'message' => 'ID unknow!'
            ], RestController::HTTP_BAD_REQUEST);
        } else {
            if ($this->am->delData($id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'deleted data!'
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found!'
                ], RestController::HTTP_NOT_FOUND);
            }
        }
    }
}
