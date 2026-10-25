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
        // edukasi
Schema::create('edukasi', function (Blueprint $table) {
    $table->id();
    $table->string('judul', 200);
    $table->text('ringkasan');
    $table->text('konten');
    $table->unsignedInteger('waktu_baca')->default(5);
    $table->unsignedInteger('poin')->default(5);
    $table->enum('icon_type', ['organik', 'anorganik', 'b3', 'umum'])->default('umum');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasi');
    }
};
