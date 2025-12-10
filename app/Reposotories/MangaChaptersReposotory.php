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
    public function __construct()
    {
        $this->mangaChaptersModel = new MangaChapters();
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
            $folderName = Str::slug($request->mangaTitle) . '-' . $id;
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

        // Get manga title
        $mangaTitle = Manga::findOrFail($manga_id)->title;

        // Folder: slug-of-title-chapterId
        $folderName = Str::slug($mangaTitle) . '-' . $chapter_id;

        foreach ($request->file('pages') as $index => $image) {
            // Store file in public storage
            $path = $image->store("manga/$folderName", 'public');

            // Save page to chapter_pages db table
            ChapterPages::create([
                'chapter_id' => $chapter_id,
                'page_number' => $index + 1,
                'path_to_page' => $path,
            ]);
        }

        return back()->with('success', 'Pages uploaded successfully!');
    }
}
