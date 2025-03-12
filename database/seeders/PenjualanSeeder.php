<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'penjualan_id' => $i,
                'user_id' => rand(1, 3), 
                'pembeli' => 'Customer ' . $i,
                'penjual_kode' => 'TRX' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'penjual_tanggal' => now(),
            ];
        }

        DB::table('t_penjualan')->insert($data);
    }
}
