<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('PatFirstName');
            $table->string('PatMiddleName');
            $table->string('PatLastName');
            $table->bigInteger('PatContact');
            $table->bigInteger('OtherToContact')->nullable();
            $table->string('PatEmail')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            //$table->bigInteger('PatAccountID'); //foreign key
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade');
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
        Schema::dropIfExists('patients');
    }
}
