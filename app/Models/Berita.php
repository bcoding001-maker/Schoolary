<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'berita_id';

    protected $fillable = [
        'judul',
        'konten',
        'thumbnail',
        'slug',
        'status',
        'is_featured',
        'user_id'
    ];

    protected $casts = [
        'is_featured' => 'boolean'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope untuk berita yang dipublikasikan
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope untuk berita utama
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    protected static function boot()
    {
        parent::boot();
        
        // Hapus file thumbnail saat model dihapus
        static::deleting(function($berita) {
            if ($berita->thumbnail) {
                Storage::disk('public')->delete('berita/' . $berita->thumbnail);
            }
        });
    }
}