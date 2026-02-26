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
     *
     * @return void
     */
     public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'usuari1',
                'email' => 'usuari1@test.cat',
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'usuari2',
                'email' => 'usuari2@test.cat',
                'password' => Hash::make('123'),
            ],
            [
                'name' => 'usuari3',
                'email' => 'usuari3@test.cat',
                'password' => Hash::make('123'),
            ],
        ]);
    }
}
