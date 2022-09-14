<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $pass=Hash::make("passwordasdffdsapassword");
        $admin=[
            'id'=>1,
            'name'=>'Zaw Min Khant',
            'email'=>'test1@admin.com',
            'password'=>"$pass",
        ];

        User::insert($admin);
    }
}
