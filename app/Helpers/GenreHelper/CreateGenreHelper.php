<?php


namespace App\Helpers\GenreHelper;


use App\Models\Genre;

class CreateGenreHelper
{
    public function genreCreate($request){
        $errors = [];

        $genreTitle = $request->title;

        $searchGenreTitle = Genre::where("title", $genreTitle)->first();

        if($searchGenreTitle !== null){ $errors["unique"] = "Такой жанр уже существует"; }
        if(empty($genreTitle)){ $errors["required"] = "Название жанра обязательно к заполнению"; }

        if(!empty($errors)){
            return [
                "genre" => ["message" => $errors],
                "code" => 400
            ];
        }

        $genre = Genre::create([
            "title" => $genreTitle
        ]);

        return [
            "genre" => $genre,
            "code" => 200
        ];
    }
}
