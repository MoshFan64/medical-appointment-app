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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            // Relación 1:1 con usuarios (un doctor es un usuario del sistema)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Relación con el catálogo de especialidades
            $table->foreignId('specialty_id')->constrained()->onDelete('restrict');

            $table->string('medical_license_number')->unique(); // Cédula Profesional
            $table->string('phone_clinic')->nullable();
            $table->text('biography')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
