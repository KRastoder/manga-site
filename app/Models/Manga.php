<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    protected $table = 'manga';
    protected $fillable = [
        'title',
        'description',
        'author_id'
    ];
}
