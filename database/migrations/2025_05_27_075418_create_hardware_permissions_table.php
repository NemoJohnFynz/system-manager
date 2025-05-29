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
        Schema::create('hardware_permissions', function (Blueprint $table) {
            $table->string('hardware_ip',25)->primary();
            $table->string('permissions_name', 100);
            $table->string('user_name', 100);
            $table->string(('user_createby'),100);
            $table->timestamp('assigned_at');
            $table->foreign('hardware_ip')->references('ip')->on('hardware')->onDelete('cascade');
            $table->foreign('permissions_name')->references('permissions_name')->on('permissions')->onDelete('cascade');
            $table->foreign('user_name')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('user_createby')->references('username')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hardware_permissions');
    }
};
