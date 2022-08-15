<?php


namespace App\Helpers\GameHelper;


use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class ViewGameHelper
{
    public function gameView($id){
        $game = Game::find($id);

        if($game === null){
            return [
                "game" => ["message" => "Выбранная вами игра не найдена"],
                "code" => 404
            ];
        }

        $genres = Genre::
            join("game_genres", "game_genres.genre_id", "=", "genres.id")
            ->where("game_genres.game_id", $game->id)
            ->select("genres.*")
            ->get();

        $gameGenres = [
            "id" => $game->id,
            "title" => $game->title,
            "studio_developer" => $game->studio_developer,
            "genres" => $genres
        ];

        return [
            "game" => $gameGenres,
            "code" => 200
        ];
    }
}
