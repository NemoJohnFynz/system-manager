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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('original_rule');
            $table->string('name', 200);
            $table->unsignedBigInteger('hardware_id');
            $table->unsignedBigInteger('hardware_rule');
            $table->unsignedBigInteger('category_id');
            $table->string('username', 100);
            $table->boolean('is_delete')->default(false);
            $table->foreign('hardware_id')->references('id')->on('hardware')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category_rule')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
