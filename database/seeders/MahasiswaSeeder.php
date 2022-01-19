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
            'gender'    => 'Male',
            'no_telp'   => '081227959976',
            'address'   => 'Jumapolo, Karanganyar'
        ]);

        Mahasiswa::create([
            'fullname' => 'Annisa Aprilia Sugesti',
            'username' => 'annisaapariliasugesti',
            'department' => 'Sistem Informasi',
            'class' => '18SIA1',
            'gender' => 'Female',
            'no_telp'   => '081227952344',
            'address'   => 'Sidamukti, Depok'
        ]);
    }
}
