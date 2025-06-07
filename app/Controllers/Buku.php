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

        //cek apakah session punya validasi lain?
        if(session()->has('validation')){
            $data['validation'] = session('validation');
        }
        return view('buku_view/buat', $data);
    }
    public function simpan(){ 
        //validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[buku_sql.judul]',
                'errors' => [
                    'required' => '{field} Judul buku harus diisi',
                    'is_unique' => '{field} buku sudah ada'
                ]
            ],
            'penulis' => [
                'rules' => 'required|is_unique[buku_sql.penulis]',
                'errors' => [
                    'required' => '{field} Nama penulis harus diisi',
                    'is_unique' => '{field} sudah terdaftar di buku lain'
                ]
            ],
            'penerbit' => [
                'rules' => 'required|is_unique[buku_sql.penerbit]',
                'errors' => [
                    'required' => '{field} Nama penerbit harus diisi',
                    'is_unique' => '{field} sudah terdaftar di buku lain'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    // 'uploaded' => 'Pilihlah gambar yang sesuai',
                    'max_size' => 'Ukuran file kebesaran',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File yang anda pilih bukan gambar'
                ]
            ],
        ])) {
            return redirect()->to('/buat')->withInput()->with('validation', $this->validator);
        }

        //konfigurasi file unggah
        $gambarSampul = $this->request->getFile('sampul');

        if($gambarSampul->getError()==4){
            $namaSampul = 'no-cover.jpg';
        } else {
            $namaSampul = $gambarSampul->getRandomName(); //generate nama gambar
            $gambarSampul -> move ('asset/gambar' , $namaSampul); //pindah file gambar

            // $namaSampul = $gambarSampul->getName();
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $data = [
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ];
        
        $this->bukuModel->save($data);

        session()->setFlashdata('pesan', 'Selamat, data berhasil ditambahkan');
        return redirect()->to('/');

}
    public function hapus($id){
        $buku = $this->bukuModel->find($id); //cari nama gambar

        if($buku['sampul'] != 'no-cover.jpg'){
            unlink('asset/gambar/' . $buku['sampul']);
        }

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

        if ($bukuLama['penulis'] == $this->request->getVar('penulis')){
            $rule_penulis = 'required';
        } else {
            $rule_penulis = 'required|is_unique[buku_sql.penulis]';
        }

        if ($bukuLama['penerbit'] == $this->request->getVar('penerbit')){
            $rule_penerbit = 'required';
        } else {
            $rule_penerbit = 'required|is_unique[buku_sql.penerbit]';
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

        //konfigurasi file unggah
        $gambarSampul = $this->request->getFile('sampul');

        if($gambarSampul->getError()==4){
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $namaSampul = $gambarSampul->getRandomName(); //generate nama gambar
            $gambarSampul -> move ('asset/gambar' , $namaSampul); //pindah file gambar
            
            // $namaSampul = $gambarSampul->getName();

            unlink('asset/gambar/' . $this->request->getVar('sampulLama'));
        }


        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->bukuModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil di ubah');

        return redirect()->to('/');
    }

    public function tes(){
        return view('buku_view/tes');
    }
}
