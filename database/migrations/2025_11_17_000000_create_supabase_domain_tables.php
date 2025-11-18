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
        if (! Schema::hasTable('kategori')) {
            Schema::create('kategori', function (Blueprint $table) {
                $table->id('kategori_id');
                $table->string('kategori_judul');
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('update_at')->useCurrent()->useCurrentOnUpdate();
            });
        }

        if (! Schema::hasTable('petugas')) {
            Schema::create('petugas', function (Blueprint $table) {
                $table->id();
                $table->string('username');
                $table->string('password');
                $table->timestamp('created_at')->nullable();
            });
        }

        if (! Schema::hasTable('profile')) {
            Schema::create('profile', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('judul');
                $table->text('isi');
                $table->timestamp('created_at')->nullable();
            });
        }

        if (! Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->bigIncrements('post_id');
                $table->string('post_judul');
                $table->unsignedBigInteger('kategori_id');
                $table->text('post_isi');
                $table->unsignedBigInteger('petugas_id');
                $table->enum('status', ['draft', 'published'])->default('draft');
                $table->timestamp('created_at')->useCurrent();

                $table->foreign('kategori_id')
                    ->references('kategori_id')
                    ->on('kategori')
                    ->cascadeOnDelete();

                $table->foreign('petugas_id')
                    ->references('id')
                    ->on('petugas')
                    ->cascadeOnDelete();
            });
        }

        if (! Schema::hasTable('galery')) {
            Schema::create('galery', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('post_id')->nullable();
                $table->integer('position')->nullable();
                $table->string('status')->nullable();

                $table->foreign('post_id')
                    ->references('post_id')
                    ->on('posts')
                    ->nullOnDelete();
            });
        }

        if (! Schema::hasTable('events')) {
            Schema::create('events', function (Blueprint $table) {
                $table->bigIncrements('event_id');
                $table->string('event_name');
                $table->text('description');
                $table->date('event_date');
                $table->string('location');
                $table->string('thumbnail')->nullable();
                $table->enum('status', ['upcoming', 'ongoing', 'completed'])->default('upcoming');
                $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (! Schema::hasTable('albums')) {
            Schema::create('albums', function (Blueprint $table) {
                $table->bigIncrements('album_id');
                $table->foreignId('parent_id')
                    ->nullable()
                    ->constrained('albums', 'album_id')
                    ->nullOnDelete();
                $table->string('album_name');
                $table->text('description')->nullable();
                $table->foreignId('kategori_id')
                    ->constrained('kategori', 'kategori_id')
                    ->cascadeOnDelete();
                $table->string('cover_image')->nullable();
                $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('beritas')) {
            Schema::create('beritas', function (Blueprint $table) {
                $table->bigIncrements('berita_id');
                $table->string('judul');
                $table->string('slug')->unique();
                $table->text('konten');
                $table->string('thumbnail')->nullable();
                $table->enum('status', ['draft', 'published'])->default('draft');
                $table->boolean('is_featured')->default(false);
                $table->unsignedInteger('view_count')->default(0);
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('agendas')) {
            Schema::create('agendas', function (Blueprint $table) {
                $table->bigIncrements('agenda_id');
                $table->string('judul');
                $table->text('deskripsi');
                $table->dateTime('tanggal_mulai');
                $table->dateTime('tanggal_selesai');
                $table->string('lokasi');
                $table->enum('status', ['upcoming', 'ongoing', 'completed'])->default('upcoming');
                $table->string('thumbnail')->nullable();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (! Schema::hasTable('gallery')) {
            Schema::create('gallery', function (Blueprint $table) {
                $table->bigIncrements('gallery_id');
                $table->foreignId('post_id')->constrained('posts', 'post_id')->cascadeOnDelete();
                $table->foreignId('album_id')->nullable()->constrained('albums', 'album_id')->nullOnDelete();
                $table->integer('position')->default(0);
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamp('created_at')->useCurrent();
            });
        }

        if (! Schema::hasTable('foto')) {
            Schema::create('foto', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('gallery_id')->constrained('gallery', 'gallery_id')->cascadeOnDelete();
                $table->string('file');
                $table->string('judul');
            });
        }

        if (! Schema::hasTable('photos')) {
            Schema::create('photos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('album_id')->constrained('albums', 'album_id')->cascadeOnDelete();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('image_path');
                $table->unsignedBigInteger('views_count')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('photo_likes')) {
            Schema::create('photo_likes', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('photo_id')->constrained('photos')->cascadeOnDelete();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('ip_address', 45);
                $table->string('user_agent')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('photo_comments')) {
            Schema::create('photo_comments', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('photo_id')->constrained('photos')->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->text('content');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('visitors')) {
            Schema::create('visitors', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('ip_address');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_comments');
        Schema::dropIfExists('photo_likes');
        Schema::dropIfExists('photos');
        Schema::dropIfExists('foto');
        Schema::dropIfExists('gallery');
        Schema::dropIfExists('agendas');
        Schema::dropIfExists('beritas');
        Schema::dropIfExists('albums');
        Schema::dropIfExists('events');
        Schema::dropIfExists('galery');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('profile');
        Schema::dropIfExists('petugas');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('visitors');
    }
};
