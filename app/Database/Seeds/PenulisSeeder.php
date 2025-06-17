<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker;
class PenulisSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'name' => 'Lail o',
        //         'address' => 'Jalan Melati',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'name' => 'Aninypo',
        //         'address' => 'Jalan Melati',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ],
        //     [
        //         'name' => 'Jehhaa',
        //         'address' => 'Jalan Melati',
        //         'created_at' => Time::now(),
        //         'updated_at' => Time::now()
        //     ]
        // ];

        // $this->db->query('INSERT INTO penulis (name, address, created_at,updated_at) VALUES (:name:,:address:,:created_at:,:updated_at:)', $data);

        //dummy data
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 50; $i++){
            $data=[
                'name' => $faker->name,
                'address' => $faker->address,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'updated_at' => Time::now()
            ];
            $this->db->table('penulis')->insert($data);
        }
        
    }
}
