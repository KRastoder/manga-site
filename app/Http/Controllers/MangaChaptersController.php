<?php

namespace App\Http\Controllers;

use App\Reposotories\MangaChaptersReposotory;
use Illuminate\Http\Request;

class MangaChaptersController extends Controller
{
    private $mangaChaptersRepo; 
    public function __construct()
    {
        $this->mangaChaptersRepo = new MangaChaptersReposotory();
    }
    public function createChapter(Request $request ,$id)
    {
        $this->mangaChaptersRepo->create($id,$request);
        
        return redirect()->back();
    }
    public function getChaptersById($manga_id,$chapter_id){
        return view('manga.addPagesToChapter',[
            'manga_id' => $manga_id,
            'chapter_id' => $chapter_id,
        ]);
    }
    public function uploadChapters(Request $request,$manga_id ,$chapter_id){
        $this->mangaChaptersRepo->upload($request,$manga_id,$chapter_id );
        return redirect()->back();
    }
    public function showChapter($chapter_id , $manga_id){
        $chapters = $this->mangaChaptersRepo->showChapters($manga_id,$chapter_id);

        if($chapters->isEmpty()){
            return abort(404);;
        }

        return view('manga.showChapterPages',[
            'chapters'=> $chapters,
        ]);


        

    }
}
