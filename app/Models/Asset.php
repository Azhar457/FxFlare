<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'name',
        'price',
        'change_24h',
    ];

    /**
     * The users that have this asset in their watchlist.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'asset_user');
    }
}
