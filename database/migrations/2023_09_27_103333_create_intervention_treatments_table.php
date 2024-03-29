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
        Schema::create('intervention_treatments', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->nullable();
            $table->string('type')->nullable();
            $table->integer('intensity')->nullable();
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
        Schema::dropIfExists('intervention_treatments');
    }
};
