<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'client_name' => 'Client 1',
                'client_contact_no' => '0000-000-0000',
                'client_address' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.',
                'client_logo' => '/images/clients/client-1.png'
            ],
            [
                'client_name' => 'Client 2',
                'client_contact_no' => '0000-000-0000',
                'client_address' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.',
                'client_logo' => '/images/clients/client-2.png'
            ],
            [
                'client_name' => 'Client 3',
                'client_contact_no' => '0000-000-0000',
                'client_address' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.',
                'client_logo' => '/images/clients/client-3.png'
            ],
            [
                'client_name' => 'Client 4',
                'client_contact_no' => '0000-000-0000',
                'client_address' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.',
                'client_logo' => '/images/clients/client-4.png'
            ],
            [
                'client_name' => 'Client 5',
                'client_contact_no' => '0000-000-0000',
                'client_address' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.',
                'client_logo' => '/images/clients/client-5.png'
            ],
            [
                'client_name' => 'Client 6',
                'client_contact_no' => '0000-000-0000',
                'client_address' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.',
                'client_logo' => '/images/clients/client-6.png'
            ],
            [
                'client_name' => 'Client 7',
                'client_contact_no' => '0000-000-0000',
                'client_address' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.',
                'client_logo' => '/images/clients/client-7.png'
            ],
            [
                'client_name' => 'Client 8',
                'client_contact_no' => '0000-000-0000',
                'client_address' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident etiro rabeta lingo.',
                'client_logo' => '/images/clients/client-8.png'
            ],
            ]);
    }
}
