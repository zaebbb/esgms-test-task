<?php


namespace App\Helpers\GenreHelper;


use App\Models\Genre;

class DeleteGenreHelper
{
    public function genreDelete($id){
        $genre = Genre::find($id);

        if($genre === null){
            return [
                "genre" => ["message" => "Выбранный вами жанр не найден"],
                "code" => 404
            ];
        }

        $genre->delete();

        return [
            "genre" => ["message" => "Выбранный вами жанр успешно удален"],
            "code" => 200
        ];
    }
}
