<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name'=>'Anik',
            'last_name'=>'Sen',
            'email'=>'aniksen@gmail.com',
            'password'=>('123456'),
            'role'=>'Admin',
            'status'=> true,

        ]);

        DB::table('users')->insert([
            'first_name'=>'Ashik',
            'last_name'=>'kamal',
            'email'=>'ashik@gmail.com',
            'password'=>('123456'),
            'role'=>'Super_Admin',
            'status'=> true,
            //'is_permission' => 1

        ]);
    }
}
