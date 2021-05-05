<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $masters = [ 
            1 => [
                'name' => 'Анжела',
                'profession' => 'Майстриня з ілюстрацій',
                'image' => 'imagesNew/team/team1.png', 
            ],
            2 => [ 
                'name' => 'Ніка',
                'profession' => 'Майстриня  з мозаїки',
                'image' => 'imagesNew/team/team2.png', 
            ],
            3 => [
                'name' => 'Валері',
                'profession' => 'Майстриня  з епоксідки',
                'image' => 'imagesNew/team/team3.png', 
            ],
            4 => [
                'name' => 'Марія',
                'profession' => 'Майстриня  з малювання',
                'image' => 'imagesNew/team/team4.png', 
            ],
        ];
        
        
        Schema::create('masters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profession');
            $table->string('image', 255);
            $table->timestamps();
        });

        foreach ($masters as $master) {
            App\Models\Master::create($master);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masters');
    }
}
