<?php namespace App\Controllers;

class Page extends BaseController {
    public function about(){
        echo "halaman tentang";
    }
    public function contact(){
        echo "halaman kontak";
    }
    public function faqs(){
        echo "halaman faq";
    }

    // tes untuk aoutoruote
    public function tos(){
        echo "halaman tos";
    }

    //tugas
    public function biodata(){
        echo "Biodata <br>";
        echo "---------- <br>";
        echo "Nama : Laila <br>";
        echo "Umur : 20 <br>";
        echo "Kelas : B <br>";
    }

}