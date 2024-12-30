<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1'),
            'level' => 'admin'
        ]);
        
        User::create([
            'name' => 'Epul',
            'email' => 'epul@gmail.com',
            'password' => Hash::make('2'),
            'level' => 'admin'
        ]);
    }
}