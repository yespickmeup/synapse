<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'icon' => 'fa-bar-chart',
                'title' => 'Lorem Ipsum',
                'description' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.'
            ],
            [
                'icon' => 'fa-picture-o',
                'title' => 'Dolor Sitema',
                'description' => 'Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata nodera clas.'
            ],
            [
                'icon' => 'fa-shopping-bag',
                'title' => 'Sed ut perspiciatis',
                'description' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur trinige zareta lobur trade.'
            ],
            [
                'icon' => 'fa-map',
                'title' => 'Magni Dolores',
                'description' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum rideta zanox satirente madera.'
            ]
            
        
            ]);
    }
}
