<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'role status',
            'category create',
            'category edite',
            'category delete',
            'post create',
            'post edite',
            'post delete',

        ];

        foreach($permissions as $permission){

            Permission::create(['name' => $permission]);

         }
    }
}
