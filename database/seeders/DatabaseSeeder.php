<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
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

        // $password = '';
        // User::create([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin'),
        //     'role' => 'admin',
        //     'last_seen' => now(),
        // ]);

        // User::create([
        //     'name' => 'Lia',
        //     'email' => 'LiaAufarrahman09@gmail.com',
        //     'password' => Hash::make('lialia'),
        //     'role' => 'pegawai',
        //     'last_seen' => now(),
        // ]);

        $this->call([
            UserSeeder::class
        ]);

    }
}
