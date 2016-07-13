<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_id')->unsigned()->nullable()->default(null);
            $table->string('caption')->nullable()->default(null);
            $table->string('attachment')->nullable()->default(null);
            $table->string('thumb_attachment')->nullable()->default(null);
            $table->integer('order_position')->unsigned()->nullable()->default(null);
            $table->integer('created_by')->unsigned()->nullable()->default(null);
            $table->integer('updated_by')->unsigned()->nullable()->default(null);
            $table->enum('is_active', [0, 1])->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('album_id')->references('id')->on('albums');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('album_galleries');
    }
}
