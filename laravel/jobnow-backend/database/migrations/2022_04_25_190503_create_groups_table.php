<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string("name", 20);
            $table->unsignedBigInteger("logo_id")->nullable();
            $table->unsignedBigInteger("author_id")->nullable();
            $table->unsignedBigInteger("company_id")->nullable();
            $table->foreign("logo_id")->references("id")->on("files");
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
        Schema::table("groups", function(Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['author_id']);
            $table->dropForeign(['logo_id']);
        });
        
        Schema::dropIfExists('groups');
    }
}
