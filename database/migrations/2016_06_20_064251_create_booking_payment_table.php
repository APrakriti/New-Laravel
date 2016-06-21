<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id')->unsigned();
            $table->string('transaction_id', 100)->nullable()->default(null);
            $table->string('status', 20)->nullable()->default(null);
            $table->string('first_name', 100)->nullable()->default(null);
            $table->string('last_name', 100)->nullable()->default(null);
            $table->string('email', 100)->nullable()->default(null);
            $table->string('payer_id', 40)->nullable()->default(null);
            $table->string('currency', 4)->nullable()->default(null);
            $table->float('transaction_amount')->nullable()->default(null);
            $table->float('transaction_fee')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('booking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('booking_payment');
    }
}
