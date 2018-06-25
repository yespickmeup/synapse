<?php

use Illuminate\Database\Seeder;

class PortfolioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portfolios')->insert([
            [
                'title' => 'Porfolio Title 1',
                'description' => 'Porfolio Description 1',
                'portfolio_type' => 'Retail',
                'portfolio_img' => '/images/portfolios/1.jpg'
            ],
            [
                'title' => 'Porfolio Title 2',
                'description' => 'Porfolio Description 2',
                'portfolio_type' => 'Retail',
                'portfolio_img' => '/images/portfolios/2.jpg'
            ],
            [
                'title' => 'Porfolio Title 3',
                'description' => 'Porfolio Description 3',
                'portfolio_type' => 'Retail',
                'portfolio_img' => '/images/portfolios/3.jpg'
            ],
            [
                'title' => 'Porfolio Title 4',
                'description' => 'Porfolio Description 4',
                'portfolio_type' => 'Retail',
                'portfolio_img' => '/images/portfolios/4.jpg'
            ],
            [
                'title' => 'Porfolio Title 5',
                'description' => 'Porfolio Description 5',
                'portfolio_type' => 'Retail',
                'portfolio_img' => '/images/portfolios/5.jpg'
            ],
            [
                'title' => 'Porfolio Title 6',
                'description' => 'Porfolio Description 6',
                'portfolio_type' => 'Retail',
                'portfolio_img' => '/images/portfolios/6.jpg'
            ],
            [
                'title' => 'Porfolio Title 7',
                'description' => 'Porfolio Description 7',
                'portfolio_type' => 'Retail',
                'portfolio_img' => '/images/portfolios/7.jpg'
            ],
            [
                'title' => 'Porfolio Title 8',
                'description' => 'Porfolio Description 8',
                'portfolio_type' => 'Retail',
                'portfolio_img' => '/images/portfolios/8.jpg'
            ],
        ]);
    }
}
