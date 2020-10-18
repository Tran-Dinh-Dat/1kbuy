<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ward', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('_name', 50);
            $table->string('_prefix', 50);
            $table->bigInteger('_province_id')->unsigned();
            $table->bigInteger('_district_id')->unsigned();
            $table->timestamps();

            $table->foreign('_province_id')->references('id')->on('province')->onDelete('cascade');
            $table->foreign('_district_id')->references('id')->on('district')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ward');
    }
}
