<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $primaryKey = 'album_id';

    protected $fillable = [
        'album_name',
        'description',
        'kategori_id',
        'parent_id',
        'cover_image',
        'created_by'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'album_id');
    }

    public function parent()
    {
        return $this->belongsTo(Album::class, 'parent_id', 'album_id');
    }

    public function children()
    {
        return $this->hasMany(Album::class, 'parent_id', 'album_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
} 