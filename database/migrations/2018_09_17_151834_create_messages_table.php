<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMessagesTable.
 */
class CreateMessagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('userOrigin_id');
            $table->unsignedInteger('userDestiny_id');
            $table->text('message');
            $table->datetime('dateTimeSend');

            $table->foreign('userOrigin_id')->references('id')->on('users')
            	->onDelete('cascade')
            	->onUpdate('cascade');
            $table->foreign('userDestiny_id')->references('id')->on('users')
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
		Schema::drop('messages');
	}
}
