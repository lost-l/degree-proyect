<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StateSeeder::class,
            LocalitySeeder::class,
            CategorySeeder::class,
            TaxSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class
        ]);

        //--------------------Factories---------------------------

        //Customers

        User::factory()->count(4)
            ->hasAddresses(2)->create()->each(function ($user) {
                $user->assignRole('customer');
            });

        //Deliverys
        User::factory()->count(2)
            ->hasAddresses(2)->create()->each(function ($user) {
                $user->assignRole('delivery');
            });

        //Products

        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');

        Product::factory()->count(8)->create();

        //-------------------------------------------------------
    }
}
