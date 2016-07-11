<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->nullable()->default(null);
            $table->integer('module_id')->unsigned()->nullable()->default(null);
            
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('module_id')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
