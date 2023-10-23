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
        Schema::create('intervention_queens', function (Blueprint $table) {
            $table->id();
            $table->date('date_queen');
            $table->string('color_queen');
            $table->boolean('rise')->default(false);
            $table->string('frames_slots')->nullable();   
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
        Schema::dropIfExists('intervention_queens');
    }
};
