<?php

namespace App\Http\Controllers;

use App\Reposotories\MangaChaptersReposotory;
use App\Reposotories\MangaReposotory;
use App\Http\Requests\CreateMangaRequest;

class MangaController extends Controller
{
    private $mangaRepo;

    public function __construct()
    {
        $this->mangaRepo = new MangaReposotory();
    
    }
    public function createMangaForm()
    {
        return view('manga.create');
    }
    public function create(CreateMangaRequest $request)
    {
        $this->mangaRepo->create($request);

        return redirect()->back();
    }
    public function myMangas(){
        
        $mangas = $this->mangaRepo->myMangas();
        return view('manga.myMangas',[
            'mangas' => $mangas,
        ]);
    }
    
}
