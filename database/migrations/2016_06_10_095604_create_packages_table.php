<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('destination_id')->unsigned();
            $table->string('heading');
            $table->string('slug')->unique();
            $table->string('title')->nullable()->default(null);
            $table->string('meta_tags')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->longText('description')->nullable()->default(null);
            $table->longText('itineraries')->nullable()->default(null);
            $table->text('includes')->nullable()->default(null);
            $table->text('excludes')->nullable()->default(null);
            $table->string('trip_duration')->nullable()->default(null);
            $table->string('team_leader')->nullable()->default(null);
            $table->string('trip_grade')->nullable()->default(null);
            $table->string('accommodation')->nullable()->default(null);
            $table->string('destination')->nullable()->default(null);
            $table->integer('group_size')->unsigned()->nullable()->default(null);
            $table->integer('maximum_altitude')->unsigned()->nullable()->default(null);
            $table->string('transportation')->nullable()->default(null);
            $table->string('trip_season')->nullable()->default(null);
            $table->date('joining_date')->nullable()->default(null);
            $table->float('previous_price')->nullable()->default(null);
            $table->float('starting_price')->nullable()->default(null);
            $table->string('start')->nullable()->default(null);
            $table->string('end')->nullable()->default(null);
            $table->string('banner_attachment')->nullable()->default(null);
            $table->string('googlemap_attachment')->nullable()->default(null);
            $table->integer('order_position')->unsigned()->nullable()->default(null);
            $table->integer('created_by')->unsigned()->nullable()->default(null);
            $table->integer('updated_by')->unsigned()->nullable()->default(null);
            $table->enum('is_special', [0, 1])->default(0);
            $table->enum('last_minute_deal', [0, 1])->default(0);
            $table->enum('is_active', [0, 1])->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('destination_id')->references('id')->on('destinations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('packages');
    }
}
