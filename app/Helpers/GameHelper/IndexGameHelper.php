<?php


namespace App\Helpers\GameHelper;


use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class IndexGameHelper
{
    public function gameIndex(){
        $gamesGenres = [];

        $games = Game::all();

        foreach($games as $game){
            $genres = Genre::
                join("game_genres", "game_genres.genre_id", "=", "genres.id")
                ->where("game_genres.game_id", $game->id)
                ->select("genres.*")
                ->get();

            $gamesGenres[] = [
                "id" => $game->id,
                "title" => $game->title,
                "studio_developer" => $game->studio_developer,
                "genres" => $genres
            ];
        }

        return [
            "game" => $gamesGenres,
            "code" => 200
        ];
    }
}
