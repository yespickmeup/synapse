<?php

use Illuminate\Database\Seeder;

class TestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testimonials')->insert([
            [
                'name' => 'Saul Goodman',
                'company' => 'Company Name',
                'designation' => 'Ceo & Founder',
                'message' => 'Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.',
                'photo' => '/images/testimonials/testimonial-1.jpg'
            ],
            [
                'name' => 'Sara Wilsson',
                'company' => 'Company Name',
                'designation' => 'Designer',
                'message' => 'Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.',
                'photo' => '/images/testimonials/testimonial-2.jpg'
            ],
            [
                'name' => 'Jena Karlis',
                'company' => 'Company Name',
                'designation' => 'Store Owner',
                'message' => 'Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.',
                'photo' => '/images/testimonials/testimonial-3.jpg'
            ],
            [
                'name' => 'Matt Brandon',
                'company' => 'Company Name',
                'designation' => 'Freelancer',
                'message' => 'Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.',
                'photo' => '/images/testimonials/testimonial-4.jpg'
            ],
            [
                'name' => 'John Larson',
                'company' => 'Company Name',
                'designation' => 'Entrepreneur',
                'message' => 'Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.',
                'photo' => '/images/testimonials/testimonial-5.jpg'
            ]
        ]);
    }
}
