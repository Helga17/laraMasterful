<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;

class CreateUserScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user_schedule = [
            1 => [1, 2, 3],
            2 => [1, 3]
        ];


        Schema::create('user_schedule', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('schedule_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });


        $masters = \App\Models\Master::get();

        foreach ($user_schedule as $schedule_id => $user_ids) {
            $schedule = \App\Models\Schedule::find($schedule_id);
            $schedule->users()->sync($user_ids);

            // $schedule->master()->attach($masters->random());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_schedule', function (Blueprint $table) {
            // $table->dropForeign('user_schedule_schedule_id_foreign');
            // $table->dropForeign('user_schedule_user_id_foreign');
        });

        Schema::dropIfExists('user_schedule');
    }
}
