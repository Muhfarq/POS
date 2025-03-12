<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'ELEC001', 'barang_nama' => 'Laptop', 'harga_beli' => 5000000, 'harga_jual' => 5500000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'ELEC002', 'barang_nama' => 'Smartphone', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'FOOD001', 'barang_nama' => 'Roti', 'harga_beli' => 5000, 'harga_jual' => 8000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'FOOD002', 'barang_nama' => 'Mie Instan', 'harga_beli' => 2000, 'harga_jual' => 3000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'DRINK001', 'barang_nama' => 'Kopi', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'DRINK002', 'barang_nama' => 'Teh Botol', 'harga_beli' => 5000, 'harga_jual' => 7000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'CLOTH001', 'barang_nama' => 'Kaos', 'harga_beli' => 50000, 'harga_jual' => 75000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'CLOTH002', 'barang_nama' => 'Celana Jeans', 'harga_beli' => 150000, 'harga_jual' => 200000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'HOME001', 'barang_nama' => 'Panci', 'harga_beli' => 80000, 'harga_jual' => 100000],
            ['barang_id' => 10, 'kategori_id' => 5,'barang_kode' => 'HOME002', 'barang_nama' => 'Blender', 'harga_beli' => 250000, 'harga_jual' => 300000],
        ];

        DB::table('m_barang')->insert($data);
    }
}
