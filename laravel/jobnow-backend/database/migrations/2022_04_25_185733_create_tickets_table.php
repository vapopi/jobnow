<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string("title", 20);
            $table->string("description");
            $table->unsignedBigInteger("author_id");
            $table->unsignedBigInteger("screenshot_id")->nullable();
            $table->foreign("author_id")->references("id")->on("users");
            $table->foreign("screenshot_id")->references("id")->on("files");
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
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['screenshot_id']);
            $table->dropForeign(['author_id']);
        });

        Schema::dropIfExists('tickets');
    }
}
