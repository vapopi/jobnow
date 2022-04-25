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
            $table->integer("likes");
            $table->unsignedBigInteger("author_id")->nullable();
            $table->unsignedBigInteger("company_id")->nullable();
            $table->unsignedBigInteger("image_id")->nullable();
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
            $table->dropForeign(['company_id']);
            $table->dropForeign(['author_id']);
        });

        Schema::dropIfExists('posts');
    }
}
