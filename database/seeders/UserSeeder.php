<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'cc' => '123456789',
            'name' => 'Pepito',
            'surname' => 'Perez',
            // 'slug' => 'pepito-perez',
            'email' => 'admin@gmail.com',
            'phone' => '123456789',
            'password' => Hash::make('admin123456')
        ]);
        $user->assignRole('admin');

        \App\Models\Address::create([
            'description' => 'Cr 10A no 74 14',
            'user_id' => $user->cc,
            'locality_id' => 5
        ]);
    }
}
