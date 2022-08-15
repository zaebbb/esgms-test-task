<?php


namespace App\Helpers\GameGenreHelper;


use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class IndexGameGenreHelper
{
    public function gameGenreIndex($genre_id){
        $genre = Genre::find($genre_id);

        if($genre === null){
            return [
                "game_genre" => ["message" => "Выбранный вами жанр не найден"],
                "code" => 404
            ];
        }

        $games = Game::
            join("game_genres", "game_genres.game_id", "=", "games.id")
            ->where("game_genres.genre_id", $genre->id)
            ->select("games.*")
            ->get();

        $gamesGenres = [
            "id" => $genre->id,
            "title" => $genre->title,
            "games" => $games,
        ];

        return [
            "game_genre" => $gamesGenres,
            "code" => 200
        ];
    }
}
