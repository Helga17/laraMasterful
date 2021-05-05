<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $workshops = [
            1 => [
                'title' => 'lorem ipsun',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor, obcaecati.',
                'image' => 'https://adornedwomanblog.files.wordpress.com/2016/09/close-up-of-hands-painting-on-artist-canvas-with-pallette-and-brush.jpeg',
            ],
            2 => [
                'title' => 'lorem ipsun',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui ex, vero cupiditate similique assumenda quibusdam id!',
                'image' => 'https://adornedwomanblog.files.wordpress.com/2016/09/close-up-of-hands-painting-on-artist-canvas-with-pallette-and-brush.jpeg',
            ],
            3 => [
                'title' => 'lorem ipsun',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error laboriosam, minus veniam similique non velit voluptate assumenda veritatis eos quis.',
                'image' => 'https://adornedwomanblog.files.wordpress.com/2016/09/close-up-of-hands-painting-on-artist-canvas-with-pallette-and-brush.jpeg',
            ],
            4 => [
                'title' => 'lorem ipsun',
                'description' => 'Error laboriosam, minus veniam similique non velit voluptate assumenda veritatis eos quis.',
                'image' => 'https://adornedwomanblog.files.wordpress.com/2016/09/close-up-of-hands-painting-on-artist-canvas-with-pallette-and-brush.jpeg',
            ],
        ];

        

        Schema::create('workshops', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('image', 255);
            $table->timestamps();
            
        });

        foreach($workshops as $workshop) {
            \App\Models\Workshop::create($workshop);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
    }
}
