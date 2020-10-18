<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SetNullInfor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informations', function (Blueprint $table) {
            $table->text('copyright')->nullable()->change();
            $table->text('bocongthuong')->nullable()->change();
            $table->string('link', 191)->nullable()->change();
            $table->string('slogan', 191)->nullable()->change();
            $table->string('header', 191)->nullable()->change();
            $table->text('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('informations', function (Blueprint $table) {
            //
        });
    }
}
