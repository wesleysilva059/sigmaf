<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vehicle_id');
            $table->string('engine');
            $table->string('engineNumber');
            $table->string('tireWeight');
            $table->integer('frontTires');
            $table->integer('backTires');
            $table->integer('protector');
            $table->integer('innerTires');
            $table->string('frontCanvasPad');
            $table->string('backCanvasPad');
            $table->string('frontTambor');
            $table->string('backTambor');
            $table->string('frontBumper');
            $table->string('backBumper');
            $table->string('vehicleBodywork');
            $table->string('spring');
            $table->integer('currentKmHr');
            
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
        Schema::dropIfExists('specifications');
    }
}
