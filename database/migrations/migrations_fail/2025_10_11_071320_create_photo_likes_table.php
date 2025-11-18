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
        if (!Schema::hasTable('photo_likes')) {
            Schema::create('photo_likes', function (Blueprint $table) {
                $table->id();
                $table->foreignId('photo_id')->constrained('photos')->onDelete('cascade');
                $table->string('ip_address', 45); // Support IPv4 and IPv6
                $table->string('user_agent')->nullable();
                $table->timestamps();

                // Prevent duplicate likes from same IP for same photo
                $table->unique(['photo_id', 'ip_address']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_likes');
    }
};
