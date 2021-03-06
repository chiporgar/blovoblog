<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            //defini esquema de la Tabla Post
            $table->string('title',120);
            $table->string('url');
            $table->mediumText('excerpt')->nullable();
            $table->text('body')->nullable();
            $table->text('iframe')->nullable();



            $table->timestamp('published_at')->nullable();

            $table->unsignedInteger('category_id')->nullable();


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
        Schema::dropIfExists('posts');
    }
}
