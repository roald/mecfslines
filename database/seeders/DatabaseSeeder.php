<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => __('Administrator'),
            'email' => 'admin@talc.nl',
            'role' => 'admin',
            'password' => Hash::make('getstarted'),
        ]);
        $admin->markEmailAsVerified();
    }
}
