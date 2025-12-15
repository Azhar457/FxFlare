<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Import model
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\Like;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'status',
        'published_at',
    ];

    //Casting tipe data
    protected $casts = [
        'published_at' => 'datetime',
    ];

    // Post dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Post dimiliki oleh satu Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Post memiliki banyak Tag (M:N)
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    // Post memiliki banyak Comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Post memiliki banyak Like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
