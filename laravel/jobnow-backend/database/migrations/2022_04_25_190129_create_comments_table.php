<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string("comment");
            $table->unsignedBigInteger("author_id");
            $table->unsignedBigInteger("ticket_id");
            $table->foreign("author_id")->references("id")->on("users");
            $table->foreign("ticket_id")->references("id")->on("tickets");
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
        Schema::table("comments", function(Blueprint $table) {
            $table->dropForeign(['ticket_id']);
            $table->dropForeign(['author_id']);
        });
        
        Schema::dropIfExists('comments');
    }
}
