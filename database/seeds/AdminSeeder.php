<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::create([
           'name' => 'Admin',
           'email' => 'admin@xeniumdigital.com',
           'role' => 'admin',
           'email_verified_at' => now(),
           'password' => bcrypt('admin@1234'),
           'admin' => 1,
           'approved_at' => now(),
       ]);
    }
}
