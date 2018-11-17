<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProvidersTable.
 */
class CreateProvidersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('providers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->unsignedInteger('city_id');
            $table->string('phone');
            $table->string('email');

            $table->foreign('city_id')->references('id')->on('cities')
            	->onDelete('cascade')
            	->onUpdate('cascade');

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
		Schema::drop('providers');
	}
}
