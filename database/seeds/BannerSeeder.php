<?php

use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Banner::insert([
            [
                'album_id' => 1,
                'image_path' => \URL::to('/').'/theme/richams/images/banners/image1.jpg',
                'title' => 'Lorem ipsum1',
                'description' => 'Lorem ipsum1 Lorem ipsum1 Lorem ipsum1 Lorem ipsum1',
                'alt' => 'Banner 1',
                'url' => \URL::to('/'),
                'order' => 1,
                'user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'album_id' => 1,
                'image_path' => \URL::to('/').'/theme/richams/images/banners/image2.jpg',
                'title' => 'Lorem ipsum2',
                'description' => 'Lorem ipsum2 Lorem ipsum2 Lorem ipsum2 Lorem ipsum2',
                'alt' => 'Banner 2',
                'url' => \URL::to('/'),
                'order' => 2,
                'user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'album_id' => 2,
                'image_path' => \URL::to('/').'/theme/richams/images/banners/sub-banner-bg.jpg',
                'title' => null,
                'description' => null,
                'alt' => null,
                'url' => null,
                'order' => 1,
                'user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'album_id' => 2,
                'image_path' => \URL::to('/').'/theme/richams/images/banners/sub-banner-bg.jpg',
                'title' => null,
                'description' => null,
                'alt' => null,
                'url' => null,
                'order' => 2,
                'user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
