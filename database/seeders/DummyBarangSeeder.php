<?php

namespace Database\Seeders;

use App\Models\BarangModels;
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
                'harga_beli' => 25000,
            ],
            // Tambahkan data lain jika diperlukan
        ];

        foreach ($barangData as $data) {
            // Periksa apakah data sudah ada sebelum membuatnya
            $existingData = BarangModels::where('nama_barang', $data['nama_barang'])->first();

            if (!$existingData) {
                BarangModels::create($data);
            }
        }
    }
}
