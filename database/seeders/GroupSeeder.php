<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::truncate();

        Group::create([
            'name' => 'Administrator',
            'description' => 'Quản trị hệ thống'
        ]);

        Group::create([
            'name' => 'Reviewer',
            'description' => 'Quản trị viên'
        ]);

        Group::create([
            'name' => 'User',
            'description' => 'Người dùng'
        ]);
    }
}
