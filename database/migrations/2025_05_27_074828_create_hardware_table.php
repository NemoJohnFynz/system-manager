<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hardware', function (Blueprint $table) {
            $table->id();
            $table->string('domain_id', 25);
            $table->string('domain', 100);
            $table->string('devision', 100);
            $table->string('server', 100);
            $table->string('hdd', 50);
            $table->string('ram', 50);
            $table->string('plus', 50);
            $table->text('services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardware');
    }
};
