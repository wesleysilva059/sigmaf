<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFilterChangesTable.
 */
class CreateFilterChangesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filter_changes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('controlPeriod');
            $table->integer('periodFilterChange');
            $table->date('nextDateFilterChange');
            $table->unsignedInteger('filterChange_id');
            $table->unsignedInteger('vehicle_id');

            $table->foreign('filterChange_id')->references('id')->on('filter_change_types')
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
		Schema::drop('filter_changes');
	}
}
