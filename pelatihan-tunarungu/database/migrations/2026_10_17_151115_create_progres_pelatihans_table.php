<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('progres_pelatihans', function (Blueprint $table) {
            $table->id();

            // Relasi ke peserta
            $table->foreignId('peserta_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Relasi ke materi pelatihan
            $table->foreignId('materi_id')
                ->constrained('materi')
                ->cascadeOnDelete();

            // Status penyelesaian materi
            $table->string('status')->default('belum');

            // Waktu materi selesai
            $table->timestamp('selesai_pada')->nullable();

            $table->timestamps();

            // Satu peserta hanya memiliki satu catatan per materi
            $table->unique(['peserta_id', 'materi_id']);
        });
    }

    /**
     * Batalkan migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_pelatihans');
    }
};
