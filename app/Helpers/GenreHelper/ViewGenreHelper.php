<?php


namespace App\Helpers\GenreHelper;


use App\Models\Genre;

class ViewGenreHelper
{
    public function genreView($id){
        $genre = Genre::find($id);

        if($genre === null){
            return [
                "genre" => ["message" => "Выбранный вами жанр не найден"],
                "code" => 404
            ];
        }

        return [
            "genre" => $genre,
            "code" => 200
        ];
    }
}
