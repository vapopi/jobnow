<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string("title", 20);
            $table->string("description");
            $table->unsignedBigInteger("author_id")->nullable();
            $table->unsignedBigInteger("company_id")->nullable();
            $table->foreign("author_id")->references("id")->on("users");
            $table->foreign("company_id")->references("id")->on("companies");
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
        Schema::table("notifications", function(Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['author_id']);
        });

        Schema::dropIfExists('notifications');
    }
}
