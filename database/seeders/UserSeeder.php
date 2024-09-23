<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'fname' => 'vinam',
            'email' => 'vinam@gmail.com',
            'password' => Hash::make('123456789')
        ]);
    }
}
