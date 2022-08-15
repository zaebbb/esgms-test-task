<?php


namespace App\Helpers\GameHelper;


use App\Models\Game;
use App\Models\GameGenre;
use App\Models\Genre;

class CreateGameHelper
{
    public function gameCreate($request){
        $errors = [];

        $gameTitle = $request->title;
        $gameStudioDeveloper = $request->studio_developer;
        $genres = $request->genres;

        $searchGameTitle = Game::where("title", $gameTitle)->first();
        $searchGenres = Genre::whereIn("id", $genres)->get();

        if($searchGameTitle !== null){ $errors["unique"] = "Такая игра уже существует"; }
        if(empty($gameTitle)){ $errors["title_required"] = "Название игры обязательно к заполнению"; }
        if(empty($gameStudioDeveloper)){ $errors["studio_required"] = "Название студии-разработчика обязательно к заполнению"; }
        if(!is_array($genres)){ $errors["genres_format"] = "Неверный формат передачи списка жанров"; }
        if(empty($genres)){ $errors["genres_required"] = "Выберите хотя-бы один жанр"; }
        if(count($searchGenres) === 0){ $errors["genres_empty"] = "Выбранные вами жанры не существуют в системе"; }

        if(!empty($errors)){
            return [
                "game" => ["message" => $errors],
                "code" => 400
            ];
        }

        $createGame = Game::create([
            "title" => $gameTitle,
            "studio_developer" => $gameStudioDeveloper
        ]);

        $game = [
            "id" => $createGame->id,
            "studio_developer" => $createGame->studio_developer,
            "genres" => [],
        ];

        foreach($searchGenres as $genre){
            GameGenre::create([
                "game_id" => $createGame->id,
                "genre_id" => $genre->id,
            ]);

            $game["genres"][] = [
                "id" => $genre->id,
                "title" => $genre->title,
            ];
        }

        return [
            "game" => $game,
            "code" => 200
        ];
    }
}
