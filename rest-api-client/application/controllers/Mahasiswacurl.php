<?php

class Mahasiswacurl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswacrl_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['judul'] = 'Daftar Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswacrl_model->getAllMahasiswa();
        $nama = $this->input->post('nama');
        if ($nama) {
            $data['mahasiswa'] = $this->Mahasiswacrl_model->cariDataMahasiswa($nama);
        }
        $this->load->view('templates/header', $data);
        $this->load->view('curl/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Mahasiswa';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('curl/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->Mahasiswacrl_model->tambahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('mahasiswacurl');
        }
    }

    public function hapus($id)
    {
        $this->Mahasiswacrl_model->hapusDataMahasiswa($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('mahasiswacurl');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswacrl_model->getMahasiswaById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('curl/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        $data['judul'] = 'Form Ubah Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswacrl_model->getMahasiswaById($id);
        $data['jurusan'] = ['Teknik Informatika', 'Teknik Mesin', 'Teknik Planologi', 'Teknik Pangan', 'Teknik Lingkungan'];

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('curl/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Mahasiswacrl_model->ubahDataMahasiswa();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('mahasiswacurl');
        }
    }
}
