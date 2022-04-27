<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("name", 20);
            $table->unsignedBigInteger("permission_id");
            $table->foreign("permission_id")->references("id")->on("permissions");
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->string("username", 20);
            $table->string("surnames", 50);
            $table->string("phone", 20)->unique();
            $table->timestamp("birth_date");
            $table->boolean("terms")->default(false);
            $table->boolean("premium")->default(false);
            $table->unsignedBigInteger("avatar_id");
            $table->unsignedBigInteger("role_id");
            $table->foreign("avatar_id")->references("id")->on("files");
            $table->foreign("role_id")->references("id")->on("roles");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['avatar_id']);
            $table->dropColumn(['role_id', 'avatar_id', 'terms', 'birth_date', 'phone', 'surnames', 'username']);
        });

        Schema::table('roles', function(Blueprint $table) {
            $table->dropForeign(['permission_id']);
        });

        Schema::dropIfExists('roles');
    }
}