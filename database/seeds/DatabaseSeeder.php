<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(ArticlesTableSeeder::class);
        // $this->call(UserTableSeeder::class);
        // $this->call(SettingsTableSeeder::class);
        // $this->call(BannerTableSeeder::class);
        // $this->call(ServicesTableSeeder::class);
        // $this->call(ClientTableSeeder::class);
        // $this->call(PortfolioTableSeeder::class);
        // $this->call(TestimonialsTableSeeder::class);
        // $this->call(TeamMembersTableSeeder::class);
        $this->call(MessageTableSeeder::class);
    }
}
