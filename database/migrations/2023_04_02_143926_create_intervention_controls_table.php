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
        Schema::create('intervention_controls', function (Blueprint $table) {
            $table->id();
            $table->boolean('glimpse_queen')->nullable();
            $table->boolean('queen_laid')->nullable();
            $table->boolean('brood')->nullable();
            $table->boolean('frames_full')->nullable();
            $table->boolean('honey')->nullable();
            $table->boolean('honey_rise')->nullable();
            $table->integer('nb_varroa')->nullable();
            $table->text('comment')->nullable();
            $table->foreignId('interventions_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('intervention_controls');
    }
};
