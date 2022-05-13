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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title", 20);
            $table->string("description");
            $table->integer("likes")->default(0);
            $table->unsignedBigInteger("author_id");
            $table->unsignedBigInteger("image_id")->nullable();
            $table->foreign("author_id")->references("id")->on("users");
            $table->foreign("image_id")->references("id")->on("files");
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
        Schema::table('posts', function(Blueprint $table) {
            $table->dropForeign(['image_id']);
            $table->dropForeign(['author_id']);
        });

        Schema::dropIfExists('posts');
    }
}
