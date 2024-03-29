<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'name', 'liked', 'views', 'imageURL', 'audioURL', 'playlist_id', 'description'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }


    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
