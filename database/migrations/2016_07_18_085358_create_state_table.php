<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_states', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('country_id');
			$table->foreign('country_id')->references('id')->on('tbl_country')->onDelete('cascade')->onUpdate('cascade');				
            $table->string('name');					
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
        //
    }
}
