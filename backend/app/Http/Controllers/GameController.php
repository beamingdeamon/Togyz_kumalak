<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Game;
use App\Models\UserColumn;
use App\Models\OpponentColumn;


class GameController extends Controller
{
    
    public function createGame(){
        $user = Auth::user();
        $user_column = UserColumn::create();
        $opponent_column = OpponentColumn::create();
        $game = Game::create([
            'user_id'=> $user->id,
            'opponent_id' => null,
            'user_column_id' => $user_column->id,
            'opponent_column_id'=> $opponent_column->id,
            'game_code' => Str::random(8),
            'move' => random_int(0, 1),
        ]);
        return response()->json($game,200);

    }


    public function getGameInfo($id){
        $game = Game::where('id', $id)->with('user','opponent','user_column','opponent_column')->first();
        if($game == null){
            return response()->json("Такой игры не существует", 500);
        }
        return response()->json($game,200);
    }

    public function connectToGame($game_code){
        $user = Auth::user();
        $game = Game::where('game_code', $game_code)->first();
        if($game == null){
            return response()->json("Неправильный код", 500);
        }
        if($game->opponent_id != null){
            return response()->json("Игра уже началась", 500);
        }
        $game->update([
            "game_status"=> "Идет игра",
            "opponent_id"=> $user->id
        ]);
        return response()->json(["Присоединение к игре прошло успешно", $game],200);
    }
}
