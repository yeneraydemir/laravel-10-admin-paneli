<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"=> "Yener",
            "email"=> "iletisim@yeneraydemir.com",
            "password"=> bcrypt("12371327"),
        ]);
        User::factory(27)->create();
    }
}
