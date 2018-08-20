<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso2');
            $table->string('name');
            $table->string('long_name');
            $table->string('iso3');
            $table->string('numcode');
            $table->string('um_member');
            $table->string('calling_code');		
            $table->string('cctld');					
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
