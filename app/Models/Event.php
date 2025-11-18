<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'event_id';
    public $timestamps = false;
    
    protected $fillable = [
        'event_name',
        'description',
        'event_date',
        'location',
        'thumbnail',
        'status',
        'created_by',
        'created_at'
    ];

    protected $casts = [
        'event_date' => 'datetime'
    ];

    // Relasi ke user (created_by)
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // Relasi ke gallery
    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'event_id', 'event_id');
    }
} 