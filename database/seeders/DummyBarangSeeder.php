<?php

namespace Database\Seeders;

use App\Models\barang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class DummyBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangData = [
            [
                'nama_barang' => 'sandal',
                'stok' => 10,
                'harga_barang' => 25000,
            ],
            [
                'nama_barang' => 'sepatu',
                'stok' => 10,
                'harga_barang' => 25000,
            ],
            [
                'nama_barang' => 'sapu',
                'stok' => 10,
                'harga_barang' => 25000,
            ],
        ];

        foreach ($barangData as $key => $val) {
            Barang::create($val);
        }
    }

}
