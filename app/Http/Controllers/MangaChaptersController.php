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
        return view('');
    }
}
