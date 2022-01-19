<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mahasiswa::create([
            'fullname' => 'Bimanyu Nugroho Firmansyah',
            'username' => 'bimanyunugrohofirmansyah',
            'department' => 'Manajemen Informatika',
            'class' => '18MIA1',
            'gender'    => 'Male'
        ]);

        Mahasiswa::create([
            'fullname' => 'Annisa Aprilia Sugesti',
            'username' => 'annisaapariliasugesti',
            'department' => 'Sistem Informasi',
            'class' => '18SIA1',
            'gender' => 'Female'
        ]);
    }
}
