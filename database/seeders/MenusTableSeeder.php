<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $menus = [
            [
                'title' => 'SLOT',
                'parent_id' => 0,
                'sort_order' => 0,
                'slug' => '/slots',
                'imgloc' => '',
                'is_active' => 1
            ], [
                'title' => 'SPORTS',
                'parent_id' => 0,
                'sort_order' => 1,
                'slug' => '/sports',
                'imgloc' => '',
                'is_active' => 1
            ], [
                'title' => 'CASINO',
                'parent_id' => 0,
                'sort_order' => 2,
                'slug' => '/casinos',
                'imgloc' => '',
                'is_active' => 1
            ], [
                'title' => 'LOTRE',
                'parent_id' => 0,
                'sort_order' => 3,
                'slug' => '/lotres',
                'imgloc' => '',
                'is_active' => 1
            ], [
                'title' => 'FISHING',
                'parent_id' => 0,
                'sort_order' => 4,
                'slug' => '/fishings',
                'imgloc' => '',
                'is_active' => 1
            ], [
                'title' => 'POKER',
                'parent_id' => 0,
                'sort_order' => 5,
                'slug' => '/pokers',
                'imgloc' => '',
                'is_active' => 1
            ], [
                'title' => 'PROMOSI',
                'parent_id' => 0,
                'sort_order' => 6,
                'slug' => '/promotions',
                'imgloc' => '',
                'is_active' => 1
            ], [
                'title' => 'BANTUAN',
                'parent_id' => 0,
                'sort_order' => 7,
                'slug' => '/helps',
                'imgloc' => '',
                'is_active' => 1
            ], [
                'title' => 'Pragmatic Play',
                'parent_id' => 1,
                'sort_order' => 1,
                'slug' => '/pragmatic_play',
                'imgloc' => 'img/pragmatic_play.jpg',
                'is_active' => 1
            ], [
                'title' => 'JOKER',
                'parent_id' => 1,
                'sort_order' => 2,
                'slug' => '/joker',
                'imgloc' => 'img/joker.png',
                'is_active' => 1
            ], [
                'title' => 'PLAYTECH',
                'parent_id' => 1,
                'sort_order' => 3,
                'slug' => '/playtech',
                'imgloc' => 'img/playtech.png',
                'is_active' => 1
            ], [
                'title' => 'SBO',
                'parent_id' => 2,
                'sort_order' => 1,
                'slug' => '/sbo',
                'imgloc' => 'img/sbo.png',
                'is_active' => 1
            ], [
                'title' => 'CMD 368',
                'parent_id' => 2,
                'sort_order' => 2,
                'slug' => '/cmd368',
                'imgloc' => 'img/cmd368.png',
                'is_active' => 1
            ], [
                'title' => 'Pragmatic Play',
                'parent_id' => 3,
                'sort_order' => 1,
                'slug' => '/pragmatic_play_3_casino',
                'imgloc' => 'img/pragmatic_play.jpg',
                'is_active' => 1
            ], [
                'title' => 'eBET',
                'parent_id' => 3,
                'sort_order' => 2,
                'slug' => '/ebet',
                'imgloc' => 'img/ebet.png',
                'is_active' => 1
            ], [
                'title' => 'JOKER',
                'parent_id' => 4,
                'sort_order' => 1,
                'slug' => '/joker',
                'imgloc' => 'img/joker.png',
                'is_active' =>
                1] ];

        Menu::query()->truncate();
        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
