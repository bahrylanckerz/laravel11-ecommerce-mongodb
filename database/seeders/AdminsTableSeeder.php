<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'     => 'Administrator',
                'type'     => 'admin',
                'phone'    => '08123456789',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'image'    => '',
                'status'   => 1,
            ]
        ];
        Admin::insert($data);
    }
}
