<?php

namespace App\Reposotories;

use App\Models\Manga;
use App\Models\MangaChapters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MangaReposotory
{
    private $mangaModel;
    private $chaptersModel;

    public function __construct()
    {
        $this->mangaModel = new Manga();
    }

    public function create($request)
    {
        $manga = $this->mangaModel->create([
            'title' => $request->title,
            'description' => $request->description,
            'author_id' => Auth::id(),
        ]);
        $folderName = Str::slug($manga->title) . '-' . $manga->id;

        Storage::disk('public')->makeDirectory("manga/$folderName");
    }

    public function myMangas()
    {
        return auth()
            ->user()
            ->mangas() 
            ->with('chapters')
            ->get();
    }
}
