<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Library',
            'username' => 'admin',
            'email' => 'admin@cscmoldova.com',
            'password' => Hash::make('1593578624')
        ]);
    }
}
