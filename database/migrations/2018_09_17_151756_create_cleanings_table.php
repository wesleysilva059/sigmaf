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
            $table->date('date');
            $table->integer('currentKmHr');
            $table->unsignedInteger('vehicle_id');
            $table->unsignedInteger('employee_id');
            $table->text('description');

            $table->foreign('vehicle_id')->references('id')->on('vehicles')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')
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
