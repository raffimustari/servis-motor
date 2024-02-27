<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\service;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::Create([
            'nama'=> 'owner',
            'username' => 'owner',
            'password' => bcrypt('owner'),
            'role' => 'owner',
        ]);
        User::Create([
            'nama'=> 'admin',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
        User::Create([
            'nama'=> 'montir',
            'username' => 'montir',
            'password' => bcrypt('montir'),
            'role' => 'montir',
        ]);
        User::Create([
            'nama'=> 'kasir',
            'username' => 'kasir',
            'password' => bcrypt('kasir'),
            'role' => 'kasir',
        ]);
        
        Service::create([
            'nama' => 'Ganti Ban Dalem Express 250/275 -17',
            'qty' => 10,
            'status' => 'ada',
            'img' => 'img/bandalem.jpeg',
            'harga' => 25000,
            'harga_jasa' => 10000
        ]);
        Service::create([
            'nama' => 'Ganti Ban Luar',
            'qty' => 10,
            'status' => 'ada',
            'img' => 'img/banluar.jpeg',
            'harga' => 625000,
            'harga_jasa' => 20000
        ]);
        Service::create([
            'nama' => 'Ganti Oli Gardan',
            'qty' => 10,
            'status' => 'ada',
            'img' => 'img\gardan.jpg',
            'harga' => 30000,
            'harga_jasa' => 20000
        ]);
        Service::create([
            'nama' => 'Ganti Oli',
            'qty' => 10,
            'status' => 'ada',
            'img' => 'img/oli.jpeg',
            'harga' => 30000,
            'harga_jasa' => 20000
        ]);

        Service::create([
            'nama' => 'Express 250/275 -17',
            'qty' => 10,
            'kategori_id' => 3,
            'status' => 'ada',
            'img' => 'img/bandalem.png',
            'harga' => 25000,
            'harga_jasa' => 10000
        ]);
        Service::create([
            'kategori_id' => 2,
            'nama' => 'Pertamina Enduro',
            'qty' => 10,
            'status' => 'ada',
            'img' => 'img/oli.png',
            'harga' => 30000,
            'harga_jasa' => 20000
        ]);
        Service::create([
            'nama' => 'SWALLOW 275/300 – 14',
            'qty' => 10,
            'kategori_id' => 3,
            'status' => 'ada',
            'img' => 'img/bandalem.png',
            'harga' => 35000,
            'harga_jasa' => 10000
        ]);
        Service::create([
            'nama' => 'IRC',
            'qty' => 10,
            'kategori_id' => 4,
            'status' => 'ada',
            'img' => 'img/banluar.png',
            'harga' => 135000,
            'harga_jasa' => 20000
        ]);
        Service::create([
            'kategori_id' => 1,
            'nama' => 'Federal Oil',
            'qty' => 10,
            'status' => 'ada',
            'img' => 'img/oli.png',
            'harga' => 50000,
            'harga_jasa' => 10000
        ]);
        Service::create([
            'nama' => 'Aspira 300/325 R14',
            'qty' => 10,
            'kategori_id' => 3,
            'status' => 'ada',
            'img' => 'img/bandalem.png',
            'harga' => 33000,
            'harga_jasa' => 10000
        ]);
        Service::create([
            'nama' => 'Michelin',
            'qty' => 10,
            'kategori_id' => 4,
            'status' => 'ada',
            'img' => 'img/banluar.png',
            'harga' => 246000,
            'harga_jasa' => 20000
        ]);
        Service::create([
            'kategori_id' => 1,
            'nama' => 'AHM',
            'qty' => 10,
            'status' => 'ada',
            'img' => '',
            'harga' => 40000,
            'harga_jasa' => 10000
        ]);
        Service::create([
            'nama' => 'Aspira 275/300 R14',
            'qty' => 10,
            'kategori_id' => 3,
            'status' => 'ada',
            'img' => '',
            'harga' => 30000,
            'harga_jasa' => 10000
        ]);
        Service::create([
            'nama' => 'dunlop',
            'qty' => 10,
            'kategori_id' => 4,
            'status' => 'ada',
            'img' => '',
            'harga' => 157000,
            'harga_jasa' => 20000
        ]);
        Service::create([
            'kategori_id' => 2,
            'nama' => 'Shell Advance ',
            'qty' => 10,
            'status' => 'ada',
            'img' => '',
            'harga' => 35000,
            'harga_jasa' => 15000
        ]);
    }
}
