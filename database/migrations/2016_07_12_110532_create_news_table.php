<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('heading');
            $table->string('slug')->unique();
            $table->text('description')->nullable()->default(null);
            $table->string('attachment')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->string('meta_tags')->nullable()->default(null);
            $table->string('meta_description')->nullable()->default(null);
            $table->date('published_date')->nullable()->default(null);
            $table->integer('created_by')->unsigned()->nullable()->default(null);
            $table->integer('updated_by')->unsigned()->nullable()->default(null);
            $table->enum('is_active', [0, 1])->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news');
    }
}
