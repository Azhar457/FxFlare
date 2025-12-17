<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Tag;

class PostTag extends Model
{
    use HasFactory;

    protected $table = 'post_tags';

    protected $fillable = [
        'post_id',
        'tag_id',
    ];

    //PostTag dimiliki oleh satu Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //PostTag dimiliki oleh satu Tag
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
