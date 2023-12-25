<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;



class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

        $role = ["superadministrator"];
        $name = ["Admin","Admin","User","User"];
        $email = ["Admin@gmail.com","Adminone@gmail.com","user@gmail.com","Userone@gmail.com"];

       
        for ($x = 0; $x < 4; $x++) {

            $user = User::create([
                'name' => $name[$x],
                'email' => $email[$x],
                'type'  => $name[$x],
                'van'   => '1',
                'password' => Hash::make('012345678'),
            ]);
    
    
            $role = Role::where('name','=','superadministrator')->first();
    
            $id = $role->id;
    
         if($user->id == '1' || $user->id == '2'){
            $user->roles()->attach($id);
         }
          
        }
        
    }


}