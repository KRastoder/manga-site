<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MangaChapters extends Model
{
    protected $fillable = [
        'manga_id',
        'chapter_number'

    ];
}
