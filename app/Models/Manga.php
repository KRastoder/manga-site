<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    protected $table = 'manga';
    protected $fillable = ['title', 'description', 'author_id'];
public function chapters()
{
    return $this->hasMany(MangaChapters::class, 'manga_id');
}

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
