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
        Schema::create('patient_acte_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patientacteid')->constrained('patient_actes');
            $table->foreignId('acteid')->constrained('actes');
            $table->decimal('montant', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_acte_details');
    }
};
