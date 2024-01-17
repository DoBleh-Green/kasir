<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin',
                'email' => 'Admin@gmail.com',
                'role' => 'Admin',
                'password' => bcrypt('admin'),
            ],
            [
                'name' => 'Kasir',
                'email' => 'Kasir@gmail.com',
                'role' => 'Kasir',
                'password' => bcrypt('kasir'),
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
