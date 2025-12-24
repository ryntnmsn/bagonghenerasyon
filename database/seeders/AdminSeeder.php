<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Ryan',
            'last_name' => 'Dev',
            'username' => 'ryandev',
            'email' => 'ryan@dev.com',
            'phone_number' => '09488321244',
            'gender' => 'male',
            'password' => Hash::make('password123')
        ]);
    }
}
