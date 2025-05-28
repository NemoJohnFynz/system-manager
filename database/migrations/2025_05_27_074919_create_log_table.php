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
        Schema::create('log', function (Blueprint $table) {
            // Primary key
            $table->id();
            // Columns
            $table->string('username', 100);
            $table->unsignedBigInteger('software_id',);
            $table->string('hardware_ip',25);
            $table->text('message');
            $table->boolean('is_delete')->default(false);
            // Foreign keys
            $table->foreign('software_id')->references('id')->on('software')->onDelete('cascade');
            $table->foreign('hardware_ip')->references('ip')->on('hardware')->onDelete('cascade');
            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log');
    }
};
