<?php

namespace App\Reposotories;

use App\Models\MangaChapters;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class MangaChaptersReposotory
{
    private $mangaChaptersModel;
    public function __construct()
    {
        $this->mangaChaptersModel = new MangaChapters();

    }
    public function create($id ,$request){
        $lastChapter = $this->mangaChaptersModel->where('manga_id',$id)->latest()->first();

        if($lastChapter)
        {
            $nextChapter = $lastChapter->chapter_number + 1;
            $this->mangaChaptersModel->create([
                'manga_id' => $id,
                'chapter_number' => $nextChapter,
            ]);
            $folderName = Str::slug($request->mangaTitle) . '-' . $id;
            Storage::disk('public')->makeDirectory("manga/$folderName/$nextChapter");

        }
        else
        {
            $this->mangaChaptersModel->create([
                'manga_id' => $id,
                'chapter_number' => 1,
            ]);
            $folderName = Str::slug($request->mangaTitle) . '-' . $id;
            Storage::disk('public')->makeDirectory("manga/$folderName/1");
        }
        return redirect()->back();
    }

}
