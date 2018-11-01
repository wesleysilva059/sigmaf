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
            $table->integer('controlPeriod');
            $table->integer('periodOilChange');
            $table->date('nextDateOilChange');
            $table->unsignedInteger('oilChange_id');
            $table->unsignedInteger('vehicle_id');

            $table->foreign('oilChange_id')->references('id')->on('oil_change_types')
            	->onDelete('cascade')
            	->onUpdate('cascade');
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
		Schema::drop('oil_changes');
	}
}
