<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => 'admin3',
        //     'email' => 'admin3@admin',
        //     'password'=> Hash::make('admin3'),
        // ]);
        // $password = '';
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'last_seen' => now(),
        ]);

        User::create([
            'name' => 'Akhmad Zaky Fanani',
            'email' => 'akhmad.z@sai.co.id',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
            'last_seen' => now(),
        ]);

        User::create([
            'name' => 'Ansori',
            'email' => 'ansori@id.yazaki.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
            'last_seen' => now(),
        ]);

        User::create([
            'name' => 'Lia',
            'email' => 'LiaAufarrahman09@gmail.com',
            'password' => Hash::make('lialia'),
            'last_seen' => now(),
        ]);

        User::create([
            'name' => 'Rochma Yulika Sari',
            'email' => 'rochma.y@sai.co.id',
            'password' => Hash::make('password'),
            'last_seen' => now(),
        ]);

        User::create([
            'name' => 'Yuwan Setyoko',
            'email' => 'yuwan.s@sai.co.id',
            'password' => Hash::make('password'),
            'last_seen' => now(),
        ]);

        User::create([
            'name' => 'Tiara',
            'email' => 'tiara.a@sai.co.id',
            'password' => Hash::make('password'),
            'last_seen' => now(),
        ]);

        User::create([
            'name' => 'Wiwik',
            'email' => 'wiwik.w@sai.co.id',
            'password' => Hash::make('password'),
            'last_seen' => now(),
        ]);

        User::create([
            'name' => 'Zazil',
            'email' => 'finance@sai.co.id',
            'password' => Hash::make('password'),
            'last_seen' => now(),
        ]);
    }
}
