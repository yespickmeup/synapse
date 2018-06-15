<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('email');
            $table->string('slogan');
            $table->string('banner_img')->nullable();
            $table->string('about_title');
            $table->text('about_description');
            $table->string('about_img')->nullable();
            $table->text('services_description');
            $table->text('clients_description');
            $table->text('portfolio_description');
            $table->text('testimonials_description');
            $table->text('call_to_action_description');
            $table->text('contact_us_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
