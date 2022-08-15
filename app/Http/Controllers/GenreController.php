<?php

namespace App\Http\Controllers;

use App\Helpers\GenreHelper\CreateGenreHelper;
use App\Helpers\GenreHelper\DeleteGenreHelper;
use App\Helpers\GenreHelper\UpdateGenreHelper;
use App\Helpers\GenreHelper\ViewGenreHelper;
use App\Helpers\ReturnApi;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public $helperReturn;
    public $findGenre;
    public $deleteGenre;
    public $createGenre;
    public $updateGenre;

    public function __construct(){
        $this->helperReturn = new ReturnApi();
        $this->findGenre = new ViewGenreHelper();
        $this->deleteGenre = new DeleteGenreHelper();
        $this->createGenre = new CreateGenreHelper();
        $this->updateGenre = new UpdateGenreHelper();
    }

    public function index(){
        $genres = Genre::all();

        return $this->helperReturn->responseApi(200, $genres);
    }

    public function create(Request $request){
        $genreCreate = $this->createGenre->genreCreate($request);

        return $this->helperReturn->responseApi($genreCreate["code"], $genreCreate["genre"]);
    }

    public function view($id){
        $genre = $this->findGenre->genreView($id);

        return $this->helperReturn->responseApi($genre["code"], $genre["genre"]);
    }

    public function update(Request $request, $id){
        $genreUpdate = $this->updateGenre->genreUpdate($request, $id);

        return $this->helperReturn->responseApi($genreUpdate["code"], $genreUpdate["genre"]);
    }

    public function delete($id){
        $genreDelete = $this->deleteGenre->genreDelete($id);

        return $this->helperReturn->responseApi($genreDelete["code"], $genreDelete["genre"]);
    }
}
