<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('article_types')->insert([
            [
                'title' => 'Regular Post',
                'slug' => 'regular_post',
            ],

            [
                'title' => 'With Form',
                'slug' => 'with_form'
            ]
        ]);
    }
}
