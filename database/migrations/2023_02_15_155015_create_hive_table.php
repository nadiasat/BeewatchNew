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
        Schema::create('hives', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('date_queen')->nullable();
            $table->string('color_queen')->nullable();
            $table->boolean('rise')->default(false);
            $table->integer('nb_frames');
            $table->integer('nb_varroa');
            $table->boolean('is_active')->default(false);
            $table->foreignId('apiary_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            //delete field
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hives');
    }
};
