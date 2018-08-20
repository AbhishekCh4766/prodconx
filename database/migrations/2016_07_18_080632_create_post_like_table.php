<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_posts_likes', function (Blueprint $table) {
            $table->increments('id');
			$table->unsignedInteger('user_id');
			$table->foreign('user_id')->references('id')->on('tbl_users')->onDelete('cascade')->onUpdate('cascade');	
			
			$table->unsignedInteger('post_id');
			$table->foreign('post_id')->references('id')->on('tbl_posts')->onDelete('cascade')->onUpdate('cascade');	
			
            $table->integer('type');	
            $table->string('ip');				
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
