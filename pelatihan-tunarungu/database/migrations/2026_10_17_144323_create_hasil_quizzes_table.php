<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_quizzes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('quiz_id')
                ->constrained('quizzes')
                ->cascadeOnDelete();

            $table->foreignId('peserta_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->unsignedInteger('jumlah_benar')->default(0);
            $table->unsignedInteger('jumlah_soal')->default(0);
            $table->decimal('nilai', 5, 2)->default(0);

            $table->string('status')->default('selesai');
            $table->timestamp('dikerjakan_pada')->nullable();

            $table->timestamps();

            $table->index(['quiz_id', 'peserta_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_quizzes');
    }
};
