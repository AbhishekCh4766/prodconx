<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkplaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_workplaces', function (Blueprint $table) {
            $table->increments('id');			
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('tbl_users')->onDelete('cascade')->onUpdate('cascade');		
            $table->string('company_name');
            $table->string('description');
            $table->string('position');		
            $table->integer('is_current');					
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
