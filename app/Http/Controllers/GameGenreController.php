<?php

namespace App\Http\Controllers;

use App\Helpers\GameGenreHelper\IndexGameGenreHelper;
use App\Helpers\GameGenreHelper\ViewGameGenreHelper;
use App\Helpers\ReturnApi;
use Illuminate\Http\Request;

class GameGenreController extends Controller
{
    public $helperReturn;
    public $indexGameGenres;
    public $viewGameGenres;

    public function __construct(){
        $this->helperReturn = new ReturnApi();
        $this->indexGameGenres = new IndexGameGenreHelper();
        $this->viewGameGenres = new ViewGameGenreHelper();
    }

    public function index($genre_id){
        $indexGameGenres = $this->indexGameGenres->gameGenreIndex($genre_id);

        return $this->helperReturn->responseApi($indexGameGenres["code"], $indexGameGenres["game_genre"]);
    }

    public function view($genre_id, $game_id){
        $viewGameGenres = $this->viewGameGenres->gameGenreView($genre_id, $game_id);

        return $this->helperReturn->responseApi($viewGameGenres["code"], $viewGameGenres["game_genre"]);
    }
}
