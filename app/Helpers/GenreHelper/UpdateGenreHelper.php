<?php


namespace App\Helpers\GenreHelper;


use App\Models\Genre;

class UpdateGenreHelper
{
    public function genreUpdate($request, $id){
        $genre = Genre::find($id);

        if($genre === null){
            return [
                "genre" => ["message" => "Выбранный вами жанр не найден"],
                "code" => 404
            ];
        }

        $errors = [];

        $genreTitle = $request->title;

        $searchGenreTitle = Genre::where("title", $genreTitle)->first();

        if($searchGenreTitle !== null && $genre->title !== $genreTitle){ $errors["unique"] = "Такой жанр уже существует"; }
        if(empty($genreTitle)){ $errors["required"] = "Обязательно к заполнению"; }

        if(!empty($errors)){
            return [
                "genre" => ["message" => $errors],
                "code" => 400
            ];
        }

        if($genre->title !== $genreTitle){
            $genre->update([
                "title" => $genreTitle
            ]);
        }

        return [
            "genre" => $genre,
            "code" => 200
        ];
    }
}
