<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UpdateGenderEmailSeeder extends Seeder
{
    public function run()
    {
        $db     = \Config\Database::connect();
        $faker  = Factory::create('id_ID'); //generate nama email gaya indonesia
        $table  = $db->table('penulis');

        $penulis = $table->get()->getResult();

        foreach ($penulis as $row) {
            $table->where('id', $row->id)->update([
                'email'  => $faker->email,
                'gender' => $faker->randomElement(['Laki-laki', 'Perempuan']),
            ]);
        }
    }
}
