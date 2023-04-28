<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        $permissions = [
            ['name' => 'locality.index'], ['name' => 'locality.create'],
            ['name' => 'locality.update'], ['name' => 'locality.destroy'],
            ['name' => 'role.index'], ['name' => 'role.create'],
            ['name' => 'role.update'], ['name' => 'role.destroy'],
            ['name' => 'address.index'], ['name' => 'address.create'],
            ['name' => 'address.update'], ['name' => 'address.destroy'],
            ['name' => 'user.index'], ['name' => 'user.create'],
            ['name' => 'user.update'], ['name' => 'user.destroy'],
            ['name' => 'order.create'],
            ['name' => 'order.update'], ['name' => 'order.destroy'],
            ['name' => 'tax.index'], ['name' => 'tax.create'],
            ['name' => 'tax.update'], ['name' => 'tax.destroy'],
            ['name' => 'state.index'], ['name' => 'state.create'],
            ['name' => 'state.update'], ['name' => 'state.destroy'],
            ['name' => 'product.create'],
            ['name' => 'product.update'], ['name' => 'product.destroy'],
            ['name' => 'category.create'],
            ['name' => 'category.update'], ['name' => 'category.destroy'],
            ['name' => 'order_product.index'], ['name' => 'order_product.create'],
            ['name' => 'order_product.update'], ['name' => 'order_product.destroy'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // create roles and assign created permissions
        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());


        Role::create(['name' => 'customer'])
            ->givePermissionTo([
                'address.index',
                'address.create',
                'address.destroy',
                'address.update',
                'order.create',
                'order.update',
                'order.destroy',
                'user.update',
            ]);

        Role::create(['name' => 'delivery'])
            ->givePermissionTo([
                'user.index',
                'address.index',
                'order.update',
            ]);
    }
}
