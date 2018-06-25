<?php

use Illuminate\Database\Seeder;

class TeamMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team_members')->insert([
            [
                'name' => 'Walter White',
                'designation' => 'Chief Executive Officer',
                'photo' => '/images/team/testimonial-1.jpg',
                'twitter_account' => '',
                'facebook_account' => '',
                'google_account' => '',
                'linkedin_account' => ''
            ],
            [
                'name' => 'Sarah Jhinson',
                'designation' => 'Product Manager',
                'photo' => '/images/team/testimonial-2.jpg',
                'twitter_account' => '',
                'facebook_account' => '',
                'google_account' => '',
                'linkedin_account' => ''
            ],
            [
                'name' => 'William Anderson',
                'designation' => 'CTO',
                'photo' => '/images/team/testimonial-3.jpg',
                'twitter_account' => '',
                'facebook_account' => '',
                'google_account' => '',
                'linkedin_account' => ''
            ],
            [
                'name' => 'Amanda Jepson',
                'designation' => 'Accountant',
                'photo' => '/images/team/testimonial-4.jpg',
                'twitter_account' => '',
                'facebook_account' => '',
                'google_account' => '',
                'linkedin_account' => ''
            ]
        ]);
    }
}
