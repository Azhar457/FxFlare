<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    //Comment dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Comment dimiliki oleh satu Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}