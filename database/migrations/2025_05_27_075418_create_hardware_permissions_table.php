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
            $table->id();
            $table->string('hardware_ip',25);
            $table->unsignedBigInteger('permissions_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger(('created_by'));
            $table->timestamp('assigned_at');
            $table->foreign('hardware_ip')->references('ip')->on('hardware')->onDelete('cascade');
            $table->foreign('permissions_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
