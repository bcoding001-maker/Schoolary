<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    // Relasi one-to-many ke posts
    public function posts()
    {
        return $this->hasMany(Post::class, 'id', 'id');
    }

    public function photoComments()
    {
        return $this->hasMany(PhotoComment::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
