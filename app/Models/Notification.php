<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['content', 'song_id', 'user_id', 'bg_url'];
    use HasFactory;

    public function comment()
    {
        return $this->hasOne(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
