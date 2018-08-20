<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMembership extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_user_memberships', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('tbl_users')->onDelete('cascade')->onUpdate('cascade');	
			
			$table->unsignedInteger('order_id');
			$table->foreign('order_id')->references('id')->on('tbl_orders')->onDelete('cascade')->onUpdate('cascade');	

			$table->dateTime('start_date');
			$table->dateTime('end_date');
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
