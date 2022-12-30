<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('AppDate');
            $table->time('AppTime');
            $table->string('AppTitle');
            $table->boolean('AppStatus');
            $table->foreignId('patient_concern_id')->nullable()->constrained('patient_concerns')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('patient_id')->nullable()->constrained('patients')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('appointments');
    }
}
