<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('tbl_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('about_me');
            $table->integer('gender_id');		
            $table->integer('user_type_id');	
            $table->integer('user_status_id');	
            $table->string('birth_date');	
            $table->integer('is_active');	
            $table->string('phone');	
            $table->string('country_id');	
            $table->integer('state_id');	
            $table->string('city')	;
            $table->string('address');	
            $table->string('post_code');	
            $table->string('profile_pic');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('email')->unique();	
            $table->string('friend_count');		
            $table->string('ip');	
            $table->string('forgot_password');				
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
