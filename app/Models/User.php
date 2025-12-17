<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Import model
use App\Models\Role;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

class User extends Authenticatable
{
    // @use HasFactory<\Database\Factories\UserFactory>
    use HasFactory, Notifiable;


    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User -> Role (Many to One)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // User -> Posts (One to Many)
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // User -> Comments (One to Many)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // User -> Likes (One to Many)
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
