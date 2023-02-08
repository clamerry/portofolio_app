<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'nama'  => 'SuperAdmin', 
                'email' => 'superadmin@admin.com',
                'password' => bcrypt('superadmin'),
                'role' => 'superadmin',
                'prodi' => null,
            ],
            [
                'nama'  => 'Admin', 
                'email' => 'admin@admin.com',
                'password' => bcrypt('adminbaru'),
                'role' => 'admin',
                'prodi' => 'S1-Teknik Komputer',
            ]
        ];

        foreach($admins as $item) {
            $admin = Admin::where('email', $item['email'])->first();
            if(empty($admin)){
                Admin::create([
                    'nama'      => $item['nama'],
                    'email'     => $item['email'],
                    'password'  => $item['password'],
                    'role' => $item['role'],
                    'prodi' => $item['prodi'],
                ]);
            }
        }
    }
}
