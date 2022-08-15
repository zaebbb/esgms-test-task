<?php


namespace App\Helpers\GameHelper;


use App\Models\Game;

class DeleteGameHelper
{
    public function gameDelete($id){
        $game = Game::find($id);

        if($game === null){
            return [
                "game" => ["message" => "Выбранная вами игра не найдена"],
                "code" => 404
            ];
        }

        $game->delete();

        return [
            "game" => ["message" => "Выбранная вами игра успешно удалена"],
            "code" => 200
        ];
    }
}
