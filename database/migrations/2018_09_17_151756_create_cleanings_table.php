<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCleaningsTable.
 */
class CreateCleaningsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cleanings', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('cleaningPeriod');
            $table->date('dateNextCleaning');
            $table->unsignedInteger('vehicle_id');

            $table->foreign('vehicle_id')->references('id')->on('vehicles')
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
		Schema::drop('cleanings');
	}
}
