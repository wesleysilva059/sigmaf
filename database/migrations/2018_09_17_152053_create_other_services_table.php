<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateOtherServicesTable.
 */
class CreateOtherServicesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('other_services', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vehicle_id');
            $table->integer('serviceType');
            $table->date('initDate');
            $table->date('endDate');
            $table->integer('currentKmHr');
            $table->unsignedInteger('provider_id');
            $table->unsignedInteger('machineShop_id');
            $table->unsignedInteger('maintenanceStatus_id');

            $table->foreign('vehicle_id')->references('id')->on('vehicles')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('machineShop_id')->references('id')->on('machine_shops')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('maintenanceStatus_id')->references('id')->on('maintenance_statuses')
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
		Schema::drop('other_services');
	}
}
