<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class OrangSeeder extends Seeder
{
  public function run()
  {
    // $data = [
    //   [
    //     'nama' => 'Rama',
    //     'alamat'    => 'Panggung',
    //     'created_at'    => Time::now(),
    //     'updated_at'    => Time::now()
    //   ],
    //   [
    //     'nama' => 'Jumai',
    //     'alamat'    => 'Kintap',
    //     'created_at'    => Time::now(),
    //     'updated_at'    => Time::now()
    //   ],
    //   [
    //     'nama' => 'Faris',
    //     'alamat'    => 'Catur',
    //     'created_at'    => Time::now(),
    //     'updated_at'    => Time::now()
    //   ],
    // ];


    $faker = \Faker\Factory::create("id_ID");
    // dd($faker->name);

    for ($i = 0; $i < 100; $i++) {
      $data = [
        'nama' => $faker->name,
        'alamat'    => $faker->address,
        'created_at'    => Time::createFromTimestamp($faker->unixTime()),
        'updated_at'    => Time::now()
      ];
      $this->db->table('orang')->insert($data);
    }

    // Simple Queries
    // $this->db->query('INSERT INTO orang (nama, alamat, created_at, updated_at) VALUES(:nama:, :alamat:, :updated_at:, :created_at:)', $data);

    // Using Query Builder
    // $this->db->table('orang')->insertBatch($data);
  }
}
