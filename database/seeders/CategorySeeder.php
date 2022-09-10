<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Session::truncate();

        Category::create([
            'name' => 'Topic 01',
            'description' => 'This is topic 01'
        ]);

        Session::create([
            'category_id' => 1,
            'session_name' => 'Session 1 09-10',
            'start_time' => '2022-09-01 00:00:00',
            'end_time' => '2022-10-01 00:00:00'
        ]);

        Session::create([
            'category_id' => 1,
            'session_name' => 'Session 2 10-11',
            'start_time' => '2022-10-02 00:00:00',
            'end_time' => '2022-11-01 00:00:00'
        ]);

        Session::create([
            'category_id' => 1,
            'session_name' => 'Session 3 11-12',
            'start_time' => '2022-11-02 00:00:00',
            'end_time' => '2022-12-01 00:00:00'
        ]);

        // New cate
        Category::create([
            'name' => 'Topic 02',
            'description' => 'This is topic 02'
        ]);

        Session::create([
            'category_id' => 2,
            'session_name' => 'Session 1 06-09',
            'start_time' => '2022-06-01 00:00:00',
            'end_time' => '2022-09-01 00:00:00'
        ]);

        Session::create([
            'category_id' => 2,
            'session_name' => 'Session 2 09-10',
            'start_time' => '2022-09-02 00:00:00',
            'end_time' => '2022-10-01 00:00:00'
        ]);

        Session::create([
            'category_id' => 2,
            'session_name' => 'Session 3 10-11',
            'start_time' => '2022-10-02 00:00:00',
            'end_time' => '2022-11-01 00:00:00'
        ]);

        Session::create([
            'category_id' => 2,
            'session_name' => 'Session 4 11-01',
            'start_time' => '2022-11-02 00:00:00',
            'end_time' => '2023-01-01 00:00:00'
        ]);
    }
}
