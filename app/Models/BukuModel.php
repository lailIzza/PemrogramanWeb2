<?php

namespace App\Models;
use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table ='buku_sql';
    protected $primaryKey ='id';
    protected $useTimestamps = true;
    protected $createdField = 'tgl_pembuatan';
    protected $updatedField = 'tgl_update';
    protected $allowedFields = ['judul', 'slug','penulis', 'penerbit', 'sampul'];

    public function getBuku($slug = false)
    {
        if($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' =>$slug])->first();
    }
}