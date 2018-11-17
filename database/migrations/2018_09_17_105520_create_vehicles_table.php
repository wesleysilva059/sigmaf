<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateVehiclesTable.
 */
class CreateVehiclesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vehicles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('vehiclePlate')->unique();
            $table->string('vehicleColor');
            $table->integer('yearManufactory');
            $table->integer('yearModel');
            $table->date('purchaseDate')->nullable();
            $table->integer('renavam');
            $table->string('chassis');
            $table->string('typeControl');
            $table->string('status');
            $table->unsignedInteger('vehicleModel_id');
            $table->unsignedInteger('costCenter_id');
            $table->unsignedInteger('vehicleType_id');
            $table->text('comments');

            $table->foreign('vehicleModel_id')->references('id')->on('vehicle_models')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('costCenter_id')->references('id')->on('cost_centers')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('vehicleType_id')->references('id')->on('vehicle_types')
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
		Schema::drop('vehicles');
	}
}
