<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $posts= [ 
            1 => [
                'title' => 'Lorem ipsum dolor sit amet.',
                'text' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est ipsa ullam sit exercitationem magnam vero laudantium minus et mollitia aut.',
                'start_date' => '2021-03-08',
                'image' => 'imagesNew/post/post1.jpg', 
            ],
            2 => [
                'title' => 'Lorem ipsum dolor sit amet.',
                'text' => 'Natus ipsum, vel dolor perspiciatis laborum voluptatem quia laboriosam dolores impedit debitis aliquid amet mollitia provident eius praesentium exercitationem totam aperiam harum.',
                'start_date' => '2021-03-14',
                'image' => 'imagesNew/post/post2.jpg', 
            ],
            3 => [
                'title' => 'Lorem ipsum dolor sit amet.',
                'text' => 'Hic, similique maxime perspiciatis quas corporis doloribus velit quisquam. Dolore accusamus odit aspernatur a rem, qui dolor minima ullam ea neque tempora tenetur laudantium minus quaerat magnam exercitationem nobis, distinctio maiores, sequi maxime sed hic fuga quo.',
                'start_date' => '2021-03-20',
                'image' => 'imagesNew/post/post3.jpg', 
            ],
        ];

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->string('start_date');
            $table->text('image');
            $table->timestamps();
        });

        foreach ($posts as $post) {
            App\Models\Post::create($post);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
