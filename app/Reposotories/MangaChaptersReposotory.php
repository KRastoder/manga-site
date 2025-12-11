<?php

namespace App\Reposotories;

use App\Models\ChapterPages;
use App\Models\Manga;
use App\Models\MangaChapters;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class MangaChaptersReposotory
{
    private $mangaChaptersModel;
    private $chapterPagesModel;
    public function __construct()
    {
        $this->mangaChaptersModel = new MangaChapters();
        $this->chapterPagesModel = new ChapterPages();
        
    }
    public function create($id, $request)
    {
        $lastChapter = $this->mangaChaptersModel->where('manga_id', $id)->latest()->first();

        if ($lastChapter) {
            $nextChapter = $lastChapter->chapter_number + 1;
            $this->mangaChaptersModel->create([
                'manga_id' => $id,
                'chapter_number' => $nextChapter,
            ]);
            $folderName = Str::slug($request->mangaTitle) . '-' . $id;
            Storage::disk('public')->makeDirectory("manga/$folderName/$nextChapter");
        } else {
            $this->mangaChaptersModel->create([
                'manga_id' => $id,
                'chapter_number' => 1,
            ]);
            $folderName = $id;
            Storage::disk('public')->makeDirectory("manga/$folderName/1");
        }
        return redirect()->back();
    }

    public function upload(Request $request, $manga_id, $chapter_id)
    {
        $request->validate([
            'pages' => 'required|array',
            'pages.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $folderName = $manga_id;

        $lastPage = $this->chapterPagesModel->where('chapter_id', $chapter_id)->max('page_number') ?? 0;

        foreach ($request->file('pages') as $index => $image) {
            $pageNumber = $lastPage + $index + 1;

            $extension = $image->getClientOriginalExtension();

            $filename = $pageNumber . '.' . $extension;

            $path = $image->storeAs("manga/$folderName", $filename, 'public');

            $this->chapterPagesModel->create([
                'manga_id' => $manga_id,
                'chapter_id' => $chapter_id,
                'page_number' => $pageNumber,
                'path_to_page' => $path,
            ]);
        }

    }
    public function showChapters($manga_id,$chapter_id){
        return $this->chapterPagesModel->where('manga_id',$manga_id)->where('chapter_id',$chapter_id)->get();
    }
}
