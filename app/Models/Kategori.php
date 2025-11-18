<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'kategori_id';
    const UPDATED_AT = 'update_at';
    const CREATED_AT = 'created_at';

    protected $fillable = [
        'kategori_judul'
    ];

    public function albums()
    {
        return $this->hasMany(Album::class, 'kategori_id', 'kategori_id');
    }
} 