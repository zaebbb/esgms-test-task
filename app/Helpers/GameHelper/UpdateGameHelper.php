<?php


namespace App\Helpers\GameHelper;


use App\Models\Game;
use App\Models\GameGenre;
use App\Models\Genre;

class UpdateGameHelper
{
    public function gameUpdate($request, $id){
        $errors = [];

        $game = Game::find($id);

        if($game === null){
            return [
                "game" => ["message" => "Выбранная вами игра не найдена"],
                "code" => 404
            ];
        }

        $gameTitle = $request->title;
        $gameStudioDeveloper = $request->studio_developer;
        $genres = $request->genres;

        $searchGameTitle = Game::where("title", $gameTitle)->first();
        $searchGenres = Genre::whereIn("id", $genres)->get();

        if($searchGameTitle !== null && $game->title !== $gameTitle){ $errors["unique"] = "Такая игра уже существует"; }
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

        $game->update([
            "title" => $gameTitle,
            "studio_developer" => $gameStudioDeveloper
        ]);

        $gameView = [
            "id" => $game->id,
            "title" => $game->title,
            "studio_developer" => $game->studio_developer,
            "genres" => [],
        ];

        $searchGameGenresDelete = GameGenre::where("game_id", $game->id)->get();

        foreach($searchGameGenresDelete as $gameGenre){
            $gameGenre->delete();
        }

        foreach($searchGenres as $genre){
            GameGenre::create([
                "game_id" => $game->id,
                "genre_id" => $genre->id,
            ]);

            $gameView["genres"][] = [
                "id" => $genre->id,
                "title" => $genre->title,
            ];
        }

        return [
            "game" => $gameView,
            "code" => 200
        ];
    }
}
