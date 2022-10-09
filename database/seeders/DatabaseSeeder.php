<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

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
        // ['fname', 'lname', 'national_id', 'email', 'phone', 'password'];

        $password = bcrypt("1234");

        \App\Models\User::factsory()->create([
            'fname' => 'ODC',
            'lname' => 'ODC',
            'email' => 'ODCadmin@orange.com',
            'national_id' => "3010541545266",
            'phone' => "02182035453",
            'password' => $password
        ]);
    }
}
