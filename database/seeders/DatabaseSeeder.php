<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\prodcutSeeder;
use Database\Seeders\UserRoleSeeder;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\permissionSeeder;
use Database\Seeders\usermodelhasrollSeeder;


class DatabaseSeeder extends Seeder
{
     /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserSeeder::class);
       

    }
}
