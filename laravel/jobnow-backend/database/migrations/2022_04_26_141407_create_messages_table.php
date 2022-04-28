<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string("message");
            $table->unsignedBigInteger("author_id");
            $table->unsignedBigInteger("receiver_id");
            $table->foreign("author_id")->references("id")->on("users");
            $table->foreign("receiver_id")->references("id")->on("users");
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
        Schema::table("messages", function(Blueprint $table) {
            $table->dropForeign(['receiver_id']);
            $table->dropForeign(['author_id']);
        });

        Schema::dropIfExists('messages');
    }
}
