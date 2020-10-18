<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddVipTimeUpdateToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('vip_date_create')->default(DB::raw('NOW()'));
            $table->date('vip_date_expired')->default(DB::raw('NOW()'));
            $table->string('vip_package')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('vip_date_create');
            $table->dropColumn('vip_date_expired');
            $table->dropColumn('vip_package');
        });
    }
}
