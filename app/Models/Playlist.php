<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'bg_color', 'imageURL'];


    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
