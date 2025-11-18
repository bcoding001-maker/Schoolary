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
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('judul');
                $table->unsignedBigInteger('kategori_id');
                $table->text('isi');
                $table->unsignedBigInteger('petugas_id');
                $table->string('status');
                $table->timestamp('created_at')->nullable();

                $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
                $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
