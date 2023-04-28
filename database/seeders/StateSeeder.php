<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            'activo', 'inactivo'
            // 'En progreso', 'Finalizado', 'activo', 'inactivo'
        ];

        foreach ($states as $state) {
            State::create([
                'name' => $state
            ]);
        }
    }
}
