<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');       // Ej. MetLife, AXA, Seguros Monterrey
            $table->string('agreement_code')->unique(); // Código único de convenio internacional
            $table->integer('coverage_percentage'); // Porcentaje que cubre (0 a 100)
            $table->text('notes')->nullable();     // Términos, condiciones o deducibles
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};