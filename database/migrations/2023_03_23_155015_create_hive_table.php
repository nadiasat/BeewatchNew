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
            $table->integer('max_nb_frames');
            //frames is string to know the type of each frame slot, e for empty, f frame, s for slot. default value is only empty slots, so max_nb_frames is the number of empty slots. eac slot is separated by a comma
            $table->string('frames_slots')->default('e,e,e,e,e,e,e,e,e,e');
            $table->integer('nb_varroa');
            $table->string('treatment')->default('none');
            //treatment is a integer to know the intensity of the treatment (0 to 3)
            $table->integer('intensity')->default(0);
            //food is a boolean to know if the hive has been given syrup
            $table->boolean('food')->default(false);
            $table->boolean('is_active')->default(false);
            $table->foreignId('apiary_id')->constrained()->onDelete('cascade');

            $table->foreignId('inventory_place_id')->nullable()->constrained()->onDelete('cascade');

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
