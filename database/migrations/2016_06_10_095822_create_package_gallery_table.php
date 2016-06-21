<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_gallery', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id')->unsigned();
            $table->string('caption')->nullable()->default(null);
            $table->string('attachment')->nullable()->default(null);
            $table->string('thumb_attachment')->nullable()->default(null);
            $table->integer('order_position')->unsigned()->nullable()->default(null);
            $table->integer('created_by')->unsigned()->nullable()->default(null);
            $table->integer('updated_by')->unsigned()->nullable()->default(null);
            $table->enum('is_cover', [0, 1])->default(0);
            $table->enum('is_active', [0, 1])->default(0);
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('package_gallery');
    }
}
