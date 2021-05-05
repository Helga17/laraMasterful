<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use SebastianBergmann\Environment\Console;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $schedules = [
            1 => [
                'title'=> 'Епоксидка',
                'description'=> 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est ipsa ullam sit exercitationem magnam vero laudantium minus et mollitia aut.',
                'start_date' => '2021-03-06 13:00',
                'end_date'=> '2021-03-06 14:30', 
                'price' => 550,
                'masterIds'=> [3],
                'isActive'=> true,
                'max_count_members' => 4,
            ],
            2 => [
                'title'=> 'Малювання',
                'description'=> 'Eius voluptate ratione expedita nesciunt quibusdam. Sed molestiae corrupti ad vero voluptatibus?',
                'start_date' => '2021-03-06 15:00',
                'end_date'=> '2021-03-06 16:30', 
                'price' => 400, 
                'masterIds'=> [4],
                'isActive'=> false,
                'max_count_members' => 6,
            ],
        ];

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('master_id')->nullable();
            // $table->integer('')
            $table->integer('price');
            $table->integer('max_count_members');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->timestamps();
        });

       
        foreach ($schedules as $schedule) {
            \App\Models\Schedule::create($schedule);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
