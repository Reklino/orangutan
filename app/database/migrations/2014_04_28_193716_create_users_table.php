<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    Schema::create('users', function($table)
	    {
	    	$table->increments('id');
	    	$table->string('username', 16);
	    	$table->string('password', 64);
	    	$table->tinyInteger('role');
	    	$table->string('group', 64);
	    	$table->string('email', 320)->unique();
	    	$table->string('remember_token')->nullable();
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
		Schema::drop('users');
	}

}
