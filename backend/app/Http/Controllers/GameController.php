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
        return response()->json($game,200);
    }

    
}
