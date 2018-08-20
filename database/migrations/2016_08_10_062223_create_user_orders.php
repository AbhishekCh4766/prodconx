<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('tbl_users')->onDelete('cascade')->onUpdate('cascade');	
			
			$table->unsignedInteger('membership_plan_id');
			$table->foreign('membership_plan_id')->references('id')->on('tbl_membership_palns')->onDelete('cascade')->onUpdate('cascade');	

			$table->decimal('amount', 5, 2);
			$table->decimal('tax', 5, 2);
			$table->decimal('discount', 5, 2);
			$table->decimal('total_amount', 5, 2);
			$table->string('payment_method');	
			$table->integer('payment_status');			
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
