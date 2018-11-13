<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateOilChangesTable.
 */
class CreateOilChangesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oil_changes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('periodOilChange');
            $table->unsignedInteger('oilChangeType_id');
            $table->unsignedInteger('vehicle_id');
            $table->unsignedInteger('employee_id');
            $table->date('initDate');
            $table->date('endDate')->nullable();
            $table->date('nextDateOilChange');
            $table->integer('currentKmHr');
            $table->unsignedInteger('maintenanceStatus_id');
            $table->foreign('oilChangeType_id')->references('id')->on('oil_change_types')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
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
		Schema::drop('oil_changes');
	}
}
