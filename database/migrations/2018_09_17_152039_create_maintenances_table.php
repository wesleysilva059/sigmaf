<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMaintenancesTable.
 */
class CreateMaintenancesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maintenances', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cod', 10);
            $table->unsignedInteger('vehicle_id');
            $table->integer('purchaseItem');
            $table->integer('localService');
            $table->string('priority');
            $table->string('story');
            $table->string('plannedMaintenance');
            $table->unsignedInteger('maintenanceCategory_id');
            $table->unsignedInteger('maintenanceStatus_id');
            $table->unsignedInteger('machineShop_id');
            $table->unsignedInteger('provider_id');
            $table->unsignedInteger('costCenter_id');
            $table->unsignedInteger('department_id');
            $table->date('initDateMaintenance');
            $table->date('endDateMaintenance');
            $table->date('expectedDateEnd');
            $table->text('serviceDescRealized');

            $table->foreign('vehicle_id')->references('id')->on('vehicles')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('maintenanceCategory_id')->references('id')->on('maintenance_categories')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('maintenanceStatus_id')->references('id')->on('maintenance_statuses')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('machineShop_id')->references('id')->on('machine_shops')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('provider_id')->references('id')->on('providers')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('costCenter_id')->references('id')->on('cost_centers')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')
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
		Schema::drop('maintenances');
	}
}
