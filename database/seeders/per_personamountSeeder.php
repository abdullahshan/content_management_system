<?php

namespace Database\Seeders;

use App\Models\per_person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class per_personamountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = per_person::create([
            'booking' => '10',
            'down' => '20',
            'status'  => '1',
        ]);
    }
}
