<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('honey_jar_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('honey_jar_id');
            $table->unsignedBigInteger('user_id');
            $table->string('other_person');
            $table->integer('nb_jar');
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
        Schema::dropIfExists('honey_jar_user');
    }
};
