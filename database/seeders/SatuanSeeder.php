<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuanSeeder extends Seeder
{
    public function run()
    {
        $satuan = ['pcs', 'pack', 'rim', 'box'];

        foreach ($satuan as $item) {
            Satuan::create(['nama_satuan' => $item]);
        }
    }
}

