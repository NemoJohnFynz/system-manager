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
        Schema::create('hardware_rule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('original_rule');
            $table->string('hardware_ip', 25);
            $table->dateTime('assigned_at')->useCurrent();
            $table->foreign('hardware_ip')->references('ip')->on('hardware')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardware_rule');
    }
};
