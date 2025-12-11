<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChapterPages extends Model
{
    protected $fillable = [
        'chapter_id',
        'page_number',
        'path_to_page',
        'manga_id',
    ];
}
