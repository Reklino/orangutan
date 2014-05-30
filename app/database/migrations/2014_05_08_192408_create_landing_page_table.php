<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingPageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lps', function($table)
	    {
	    	$table->increments('id');
	    	$table->integer('user_id');
	    	$table->string('group', 128);
	    	$table->string('ad_number', 64);
	    	$table->string('file', 64);
	    	$table->string('coupon', 64);
	    	$table->string('video');
	    	$table->string('url');
	    	$table->string('facebook');
	    	$table->string('twitter');
	    	$table->string('google_plus');
	    	$table->string('linkedin');
	    	$table->string('pinterest');
	    	$table->string('hotspots');
	    	$table->string('email_form');
	    	$table->string('lead_capture_email');
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
		Schema::drop('lps');
	}

}
