<?php

namespace Database\Seeders;

use App\Models\product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Abdullah',
            'email' => 'admin@gmail.com',
            'type'  => 'admin',
            'password' => Hash::make('012345678'),
        ]);

    }


}