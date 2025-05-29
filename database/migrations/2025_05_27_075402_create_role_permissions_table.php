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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->string('role_name',100)->primary();
            $table->string('permission_name', 100);
            $table->timestamp('assigned_at');
            $table->foreign('role_name')->references('role_name')->on('roles')->onDelete('cascade');
            $table->foreign('permission_name')->references('permissions_name')->on('permissions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
