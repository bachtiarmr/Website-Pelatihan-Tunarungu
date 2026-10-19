<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            // Menambahkan kolom yang kurang
            $table->foreignId('materi_id')
                  ->nullable()
                  ->after('deskripsi')
                  ->constrained('materi')
                  ->nullOnDelete();

            $table->string('status')->default('draft')->after('materi_id');
            $table->integer('durasi_menit')->default(15)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropForeign(['materi_id']);
            $table->dropColumn(['materi_id', 'status', 'durasi_menit']);
        });
    }
};