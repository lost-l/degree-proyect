<?php

namespace Database\Seeders;

use App\Models\Locality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $localities = [
            ['name' => 'Usaquén', 'price' => '2500'],
            ['name' => 'Chapinero', 'price' => '2600'],
            ['name' => 'Santa Fe', 'price' => '2700'],
            ['name' => 'San Cristóbal', 'price' => '2800'],
            ['name' => 'Usme', 'price' => '2900'],
            ['name' => 'Tunjuelito', 'price' => '3500'],
            ['name' => 'Bosa', 'price' => '3600'],
            ['name' => 'Kennedy', 'price' => '3700'],
            ['name' => 'Fontibón', 'price' => '3800'],
            ['name' => 'Engativá', 'price' => '3900'],
            ['name' => 'Suba', 'price' => '4500'],
            ['name' => 'Barrios Unidos', 'price' => '4600'],
            ['name' => 'Teusaquillo', 'price' => '4700'],
            ['name' => 'Los Mártires', 'price' => '4800'],
            ['name' => 'Antonio Nariño', 'price' => '4900'],
            ['name' => 'Puente Aranda', 'price' => '5500'],
            ['name' => 'Candelaria', 'price' => '6500'],
            ['name' => 'Rafael Uribe Uribe', 'price' => '6600'],
            ['name' => 'Ciudad Bolívar', 'price' => '6700'],
            ['name' => ' Sumapaz', 'price' => '6800'],
        ];
        foreach ($localities as $locality) {
            Locality::create($locality);
        }
    }
}
