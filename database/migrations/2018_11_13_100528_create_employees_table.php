<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEmployeesTable.
 */
class CreateEmployeesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('registration');
            $table->unsignedInteger('occupation_id');

            $table->foreign('occupation_id')->references('id')->on('occupation')
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
		Schema::drop('employees');
	}
}
