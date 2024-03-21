<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(array(
            array(
                'name' => 'Admin Jay',
                'phone' => '08282817721',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 1,
            ),
            array(
                'name' => 'Staff Uwoon',
                'phone' => '098237823',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 2,
            ),
            array(
                'name' => 'User Hisenk',
                'phone' => '08244616626',
                'email' => 'user@gmail.com',
                'password' => Hash::make('123456'),
                'role' => 3,
            ),
        ));
    }
}
