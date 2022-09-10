<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        
        User::create([
            'group_id' => 1,
            'fullname' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'bio' => 'No description',
            'profile_image' => '',
            'password' => 'abc123', 
            'points' => 0,
            'status' => 1
        ]);

        User::create([
            'group_id' => 2,
            'fullname' => 'Reviewer 01',
            'username' => 'reviewer01',
            'email' => 'reviewer01@gmail.com',
            'bio' => 'No description',
            'profile_image' => '',
            'password' => 'abc123', 
            'points' => 0,
            'status' => 1
        ]);

        User::create([
            'group_id' => 3,
            'fullname' => 'User 01',
            'username' => 'user01',
            'email' => 'user01@gmail.com',
            'bio' => 'No description',
            'profile_image' => '',
            'password' => 'abc123', 
            'points' => 0,
            'status' => 1
        ]);

    }
}
