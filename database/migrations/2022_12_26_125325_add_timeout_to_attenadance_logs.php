<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimeoutToAttenadanceLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_logs', function (Blueprint $table) {
            $table->time('AttOut')->nullable();
            $table->string('SelfiOut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_logs', function (Blueprint $table) {
            $table->dropColumn('AttOut');
            $table->dropColumn('SelfiOut');
        });
    }
}
