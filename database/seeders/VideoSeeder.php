<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            [
                'name' => 'Test',
                'video' => 'uploads/videos/Test.mp4',
                'thumbnail' => 'uploads/images/Test.jpg',
                'length' => '5',
                'release_date' => date('Y-m-d', strtotime('15-12-2021')),
                'description' => 'Test',
                'trending' => '1',
                'category_id' => '1',
                'status' => 1,
                'created_at' => now()->toDate(),
                'updated_at' => now()->toDate(),
            ],
            [
                'name' => 'Test1',
                'video' => 'uploads/videos/Test1.mp4',
                'thumbnail' => 'uploads/images/Test1.jpg',
                'length' => '5',
                'release_date' => date('Y-m-d', strtotime('30-12-2021')),
                'description' => 'Test1',
                'trending' => '0',
                'category_id' => '1',
                'status' => 1,
                'created_at' => now()->toDate(),
                'updated_at' => now()->toDate(),
            ]
        ]);
    }
}
