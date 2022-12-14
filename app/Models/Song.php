<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'name', 'liked', 'views', 'category'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }


    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }
}
