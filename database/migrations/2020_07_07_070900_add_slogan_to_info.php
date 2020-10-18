<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSloganToInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informations', function (Blueprint $table) {
            $table->string('slogan')->default(null);
            $table->string('home')->default(null);
            $table->string('blog')->default(null);
            $table->string('shop')->default(null);
            $table->string('notify')->default(null);
            $table->string('banner')->default(null);
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
            $table->dropColumn('slogan');
            $table->dropColumn('home');
            $table->dropColumn('blog');
            $table->dropColumn('shop');
            $table->dropColumn('notify');
            $table->dropColumn('banner');
        });
    }
}
