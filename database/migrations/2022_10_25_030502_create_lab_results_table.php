<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id();
            $table->string('ResultDoc')->nullable();
            $table->string('ResulTitle')->nullable();
            $table->string('Notes')->nullable();
            //$table->bigInteger('LabApptID'); // foreign key
            $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('patients_id')->nullable()->constrained('patients')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('lab_results');
    }
}
