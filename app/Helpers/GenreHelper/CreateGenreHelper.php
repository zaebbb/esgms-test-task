<?php


namespace App\Helpers\GenreHelper;


use App\Helpers\ValidateHelper;
use App\Models\Genre;

class CreateGenreHelper
{
    public $validateData;

    public function __construct(){
        $this->validateData = new ValidateHelper();
    }

    public function genreCreate($request){
        $errors = [];

        $genreTitle = $this->validateData->validateString($request->title);

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
