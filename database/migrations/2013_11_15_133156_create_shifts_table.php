<?php

use App\Models\Shifts;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('ShiftTitle');
            $table->time('TimeIn');
            $table->time('TimeOut');
            $table->timestamps();
        });

        // Insert some stuff
        Shifts::table('shifts')->insert(
            array(
                'ShiftTitle' => 'regular',
                'TimeIn' => '08:00:00',
                'TimeOut' => '16:00:00',
        )
    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
