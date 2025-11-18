<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PhotoLikeController;
use App\Http\Controllers\PhotoCommentController;
use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])
        ->middleware(['auth'])
        ->name('profile.avatar');
});

// Route untuk semua user yang sudah login (admin dan user biasa)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Route untuk Gallery/Album
    Route::resource('album', AlbumController::class);
    Route::delete('albums/destroy-multiple', [AlbumController::class, 'destroyMultiple'])->name('album.destroy.multiple');
    
    // Photo routes
    Route::controller(PhotoController::class)->group(function () {
        Route::get('photo/create/{album_id}', 'create')->name('photo.create');
        Route::post('photo/store', 'store')->name('photo.store');
        Route::delete('photo/{photo}', 'destroy')->name('photo.destroy');
        Route::delete('photos/multiple', 'destroyMultiple')->name('photo.destroy.multiple');

        // Admin photo report (hanya tambah, tidak mengubah fitur yang ada)
        Route::get('photo/report', 'report')->name('photo.report');
    });

    // Route untuk berita
    Route::resource('berita', BeritaController::class);

    // Route untuk agenda
    Route::resource('agenda', AgendaController::class);

    // Route untuk kategori
    Route::resource('kategori', KategoriController::class);
});

// Route khusus untuk admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Management Admin (hanya bisa diakses admin)
    Route::get('/management', [AdminController::class, 'index'])->name('management');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [AdminController::class, 'update'])->name('update');
    Route::delete('/destroy/{user}', [AdminController::class, 'destroy'])->name('destroy');
});

Route::get('/view-album/{id}', [AlbumController::class, 'getAlbumContent'])->name('view.album');

Route::get('/preview-berita/{berita}', function(App\Models\Berita $berita) {
    return response()->json([
        'judul' => $berita->judul,
        'konten' => $berita->konten,
        'thumbnail' => $berita->thumbnail,
        'created_at' => $berita->created_at,
        'user' => $berita->user
    ]);
});

Route::get('/search-albums', [WelcomeController::class, 'searchAlbums'])->name('search.albums');

// Route untuk melihat detail album di halaman publik
Route::get('/album/{album}', [WelcomeController::class, 'showAlbum'])->name('album.show');

// Route untuk photo likes (public - tidak perlu login)
Route::post('/photo/{photo}/like', [PhotoLikeController::class, 'toggle'])->name('photo.like.toggle');
Route::get('/photo/{photo}/likes', [PhotoLikeController::class, 'getLikes'])->name('photo.likes.get');
Route::post('/photo/{photo}/view', [PhotoLikeController::class, 'incrementView'])->name('photo.view.increment');

// Route untuk komentar foto
Route::get('/photo/{photo}/comments', [PhotoCommentController::class, 'index'])->name('photo.comments.index');
Route::post('/photo/{photo}/comments', [PhotoCommentController::class, 'store'])->middleware('auth')->name('photo.comments.store');

require __DIR__.'/auth.php';
