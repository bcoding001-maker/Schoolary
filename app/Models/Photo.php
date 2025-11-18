<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'title',
        'description',
        'image_path',
        'views_count'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id', 'album_id');
    }

    public function likes()
    {
        return $this->hasMany(PhotoLike::class);
    }

    public function comments()
    {
        return $this->hasMany(PhotoComment::class);
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function isLikedByIp($ipAddress)
    {
        return $this->likes()->where('ip_address', $ipAddress)->exists();
    }

    public function isLikedByCurrentUserOrIp(string $ipAddress): bool
    {
        $userId = Auth::id();

        if ($userId) {
            return $this->likes()->where('user_id', $userId)->exists();
        }

        return $this->isLikedByIp($ipAddress);
    }
} 