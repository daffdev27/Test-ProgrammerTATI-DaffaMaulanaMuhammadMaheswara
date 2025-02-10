<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $kepalaDinas = Pegawai::create(['nama' => 'Kepala Dinas', 'role' => 'kepala_dinas']);

        $kepalaBidang1 = Pegawai::create(['nama' => 'Kepala Bidang 1', 'role' => 'kepala_bidang_1', 'atasan_id' => $kepalaDinas->id]);
        $kepalaBidang2 = Pegawai::create(['nama' => 'Kepala Bidang 2', 'role' => 'kepala_bidang_2', 'atasan_id' => $kepalaDinas->id]);

        Pegawai::create(['nama' => 'Staff 1', 'role' => 'staff_1', 'atasan_id' => $kepalaBidang1->id]);
        Pegawai::create(['nama' => 'Staff 2', 'role' => 'staff_2', 'atasan_id' => $kepalaBidang2->id]);
    }
}

