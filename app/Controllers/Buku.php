<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bukuModel;
    public function __construct()
    {
        $this ->bukuModel = new BukuModel();
    }
    public function index(): string
    {
        // $buku = $this->bukuModel->findAll();
        $data =[
            'title' => 'Daftar Buku',  //judul halaman
            'active_nav' => 'index',  //nav-link agar active
            'buku' => $this->bukuModel->getBuku()
        ];
        
        return view('buku_view/beranda', $data);
    }
    public function detail($slug): string
    {
        $data = [
            'title' => 'Detail Buku',  //judul halaman
            'active_nav' => 'detail',  //nav-link agar active
            'buku' => $this->bukuModel->getBuku($slug)
        ];
        //jika buku tidak ada
        if(empty($data['buku'])){
           throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Buku ' . $slug . ' tidak ditemukan!');
        }
        return view('buku_view/detail', $data);
    }
    public function buat(): string
    {
        $data = [
            'title' => 'Tambah Data Buku',  //judul halaman
            'validation' => \Config\Services::validation(),
            'active_nav' => 'tambah'   //nav-link agar active
        ];
        return view('buku_view/buat', $data);
    }
    public function simpan(){
    try {
        // Debug data input
        // dd($this->request->getPost());
        
        //validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[buku_sql.judul]',
                'errors' => [
                    'required' => '{field} buku harus diisi',
                    'is_unique' => '{field} buku sudah ada'
                ]
            ],
            'penulis' => 'required',
            'penerbit' => 'required'
        ])) {
            return redirect()->to('/buku/buat')->withInput()->with('validation', $this->validator);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $data = [
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ];

        // Debug data sebelum save
        // dd($data);

        $this->bukuModel->save($data);

        session()->setFlashdata('pesan', 'Selamat, data berhasil ditambahkan');
        return redirect()->to('/');

    } catch (\Exception $e) {
        // Tampilkan error sebenarnya
        die($e->getMessage());
    }
}
    public function hapus($id){
        $this->bukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/');
    }

    public function edit($slug){
        $data = [
            'title' => 'Form Edit data Buku',
            'validation' => \Config\Services::validation(),
            'buku' => $this->bukuModel->getBuku($slug)
        ];

        return view('buku_view/edit', $data);
    }

    public function update($id){
        //fungsi cek judul buku yang tersedia
        $bukuLama = $this->bukuModel->getBuku($this->request->getVar('slug'));
        if ($bukuLama['judul'] == $this->request->getVar('judul')){
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[buku_sql.judul]';
        }

        //validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} buku harus di isi',
                    'is_unique' => '{field} buku harus dimasukkan'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('buku/edit' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil di ubah');

        return redirect()->to('/');
    }
}
