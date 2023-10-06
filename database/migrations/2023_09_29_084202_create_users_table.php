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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('full_name'); // Full Name as a string
            $table->string('email')->unique(); // Email Address as a unique string
            $table->string('phone')->nullable(); // Phone Number as a nullable string
            $table->string('address')->nullable(); // House Address as a nullable string
            $table->string('password'); // Password as a string
            $table->timestamps(); // Created_at and Updated_at timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
