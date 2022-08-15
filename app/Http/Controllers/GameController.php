<?php

namespace App\Http\Controllers;

use App\Helpers\GameHelper\CreateGameHelper;
use App\Helpers\GameHelper\IndexGameHelper;
use App\Helpers\GameHelper\UpdateGameHelper;
use App\Helpers\GameHelper\ViewGameHelper;
use App\Helpers\GameHelper\DeleteGameHelper;
use App\Helpers\ReturnApi;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public $helperReturn;
    public $indexGame;
    public $viewGame;
    public $deleteGame;
    public $createGame;
    public $updateGame;

    public function __construct(){
        $this->helperReturn = new ReturnApi();
        $this->indexGame = new IndexGameHelper();
        $this->viewGame = new ViewGameHelper();
        $this->deleteGame = new DeleteGameHelper();
        $this->createGame = new CreateGameHelper();
        $this->updateGame = new UpdateGameHelper();
    }

    public function index(){
        $games = $this->indexGame->gameIndex();

        return $this->helperReturn->responseApi($games["code"], $games["game"]);
    }

    public function create(Request $request){
        $gameCreate = $this->createGame->gameCreate($request);

        return $this->helperReturn->responseApi($gameCreate["code"], $gameCreate["game"]);
    }

    public function view($id){
        $game = $this->viewGame->gameView($id);

        return $this->helperReturn->responseApi($game["code"], $game["game"]);
    }

    public function update(Request $request, $id){
        $gameUpdate = $this->updateGame->gameUpdate($request, $id);

        return $this->helperReturn->responseApi($gameUpdate["code"], $gameUpdate["game"]);
    }

    public function delete($id){
        $gameDelete = $this->deleteGame->gameDelete($id);

        return $this->helperReturn->responseApi($gameDelete["code"], $gameDelete["game"]);
    }
}
