<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateModelsTable.
 */
class CreateVehicleModelsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vehicle_models', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('make_id');

            $table->foreign('make_id')->references('id')->on('makes')
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
		Schema::drop('vehicleModels');
	}
}
