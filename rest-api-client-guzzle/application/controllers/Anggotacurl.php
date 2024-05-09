<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggotacurl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggotacurl_model', 'acm');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Daftar Anggota Guzzle';
        $data['mahasiswa'] = $this->acm->getAllMahasiswa();
        if ($this->input->post('keyword')) {
            $data['mahasiswa'] = $this->acm->cariDataMahasiswa();
        }
        $this->load->view('templates/header', $data);
        $this->load->view('anggotacurl/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data';

        $this->form_validation->set_rules('nama_anggota', 'nama anggota', 'required');
        $this->form_validation->set_rules('no_anggota', 'no anggota', 'required|numeric');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('anggotacurl/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->acm->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('anggotacurl');
        }
    }

    public function hapus($id)
    {
        $this->acm->hapusDataMahasiswa($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('anggotacurl');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Data';
        $data['mahasiswa'] = $this->acm->getMahasiswaById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('anggotacurl/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        $data['judul'] = 'Form Ubah Data';
        $data['mahasiswa'] = $this->acm->getMahasiswaById($id);

        $this->form_validation->set_rules('nama_anggota', 'nama anggota', 'required');
        $this->form_validation->set_rules('no_anggota', 'nomor anggota', 'required|numeric');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('anggotacurl/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->acm->ubahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('anggotacurl');
        }
    }
}
