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
            $table->string('engine')->nullable();
            $table->string('engineNumber')->nullable();
            $table->string('tireWeight')->nullable();
            $table->integer('frontTires')->nullable();
            $table->integer('backTires')->nullable();
            $table->integer('protector')->nullable();
            $table->integer('innerTires')->nullable();
            $table->string('frontCanvasPad')->nullable();
            $table->string('backCanvasPad')->nullable();
            $table->string('frontTambor')->nullable();
            $table->string('backTambor')->nullable();
            $table->string('frontBumper')->nullable();
            $table->string('backBumper')->nullable();
            $table->string('vehicleBodywork')->nullable();
            $table->string('spring')->nullable();
            $table->integer('currentKmHr')->nullable();
            
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
