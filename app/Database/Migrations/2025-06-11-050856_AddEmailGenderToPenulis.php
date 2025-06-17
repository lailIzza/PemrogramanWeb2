<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailGenderToPenulis extends Migration
{
    public function up()
    {
        $this->forge->addColumn('penulis',[
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'after' => 'name', //letak kolom
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'after' => 'gender', //letak kolom
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('penulis',['email','gender']);
    }
}
