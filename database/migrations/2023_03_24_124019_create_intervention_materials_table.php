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
        Schema::create('intervention_materials', function (Blueprint $table) {
            $table->id();
            $table->boolean('new_rise')->nullable();
            //$table->boolean('partitions_full')->nullable();
            $table->integer('new_nb_frames')->nullable();
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
        Schema::dropIfExists('intervention_materials');
    }
};
