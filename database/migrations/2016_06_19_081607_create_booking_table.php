<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('number_of_traveller')->nullable()->default(null);
            $table->date('arrival_date')->nullable()->default(null);
            $table->date('departure_date')->nullable()->default(null);
            $table->double('amount', 10,2)->nullable()->default(null);
            $table->string('first_name', 50)->nullable()->default(null);
            $table->string('last_name', 50)->nullable()->default(null);
            $table->integer('country_id')->unsigned();
            $table->string('address', 100)->nullable()->default(null);
            $table->string('contact_number', 16)->nullable()->default(null);
            $table->string('email_address', 100)->nullable()->default(null);
            $table->enum('is_active', [0, 1])->default(0);            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('booking');
    }
}
