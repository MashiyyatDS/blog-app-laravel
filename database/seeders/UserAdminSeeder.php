<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'Mashiyyat',
            'lastname' => 'Delos Santos',
            'email' => 'delossantos.mash@gmail.com',
            'password' => Hash::make('11111111')
        ]);
    }
}
