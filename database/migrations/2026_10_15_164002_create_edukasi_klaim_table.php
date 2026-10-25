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
        // edukasi_klaim
Schema::create('edukasi_klaim', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('edukasi_id')->constrained('edukasi')->cascadeOnDelete();
    $table->unsignedInteger('poin_didapat');
    $table->unique(['user_id', 'edukasi_id']); // anti klaim ganda
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasi_klaim');
    }
};
