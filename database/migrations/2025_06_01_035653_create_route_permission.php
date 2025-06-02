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
        Schema::create('route_permission', function (Blueprint $table) {
            $table->id();
            $table->string('route_name',100);
            $table->string('permissions_name',100);
            $table->timestamps();
            $table->foreign('permissions_name')->references('permissions_name')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_permission');
    }
};
