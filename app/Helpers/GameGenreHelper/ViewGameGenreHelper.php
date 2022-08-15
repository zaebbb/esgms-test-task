<?php


namespace App\Helpers\GameGenreHelper;


use App\Models\Game;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;

class ViewGameGenreHelper
{
    public function gameGenreView($genre_id, $game_id){
        $genre = Genre::find($genre_id);

        if($genre === null){
            return [
                "game_genre" => ["message" => "Выбранный вами жанр не найден"],
                "code" => 404
            ];
        }

        $game = Game::
            join("game_genres", "game_genres.game_id", "=", "games.id")
            ->where([
                ["game_genres.genre_id", $genre->id],
                ["game_genres.game_id", $game_id],
            ])
            ->select("games.*")
            ->get()
            ->first();

        if($game === null){
            return [
                "game_genre" => ["message" => "Выбранная вами игра не найдена по найденному жанру"],
                "code" => 404
            ];
        }

        $gamesGenres = [
            "id" => $genre->id,
            "title" => $genre->title,
            "game" => $game,
        ];

        return [
            "game_genre" => $gamesGenres,
            "code" => 200
        ];
    }
}
