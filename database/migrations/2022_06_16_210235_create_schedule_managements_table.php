<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_managements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('field_types_id');
            $table->foreign('field_types_id')->references('id')->on('field_types');
            $table->integer('price')->nullable();
            $table->timeTz('time', $precision = 0)->nullable();
            $table->date('date')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('schedule_managements');
    }
};
