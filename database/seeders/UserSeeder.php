<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Dorothy',
            'middle_names' => 'Fluffy Strokes',
            'surname' => 'Amon',
            'username' => 'nkay',
            'email' => 'naakotey52@gmail.com',
            'phone' => '0595319756',
            'password' => Hash::make("Decode@20"),
            'user_id' => "USR_1",
            'createuser' => 'naakotey52@gmail.com',
            'modifyuser' => 'naakotey52@gmail.com',
            'email_verified_at' => now()
        ]);
    }
}
