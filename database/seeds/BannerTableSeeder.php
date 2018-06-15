<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
        [
            'banner_img' => '/images/banners/1.jpg'
        ],
        [
            'banner_img' => '/images/banners/2.jpg'
        ],
        [
            'banner_img' => '/images/banners/3.jpg'
        ],
        [
            'banner_img' => '/images/banners/4.jpg'
        ],
        [
            'banner_img' => '/images/banners/5.jpg'
        ],
        [
            'banner_img' => '/images/banners/6.jpg'
        ]
    
        ]);
    }
}
