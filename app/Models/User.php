<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Import model
use App\Models\Role;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Asset;
use App\Models\PriceAlert;

class User extends Authenticatable {
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

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', //Memastikan password selalu di-hash otomatis
        ];
    }

    public function hasRole(string $roleName): bool {
        return $this->role && $this->role->name === $roleName;
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function watchlist() {
        return $this->belongsToMany(Asset::class, 'asset_user');
    }

    public function priceAlerts() {
        return $this->hasMany(PriceAlert::class);
    }
}