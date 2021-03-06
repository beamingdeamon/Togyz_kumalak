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

class MoveController extends Controller
{
    public function userMove(Request $request, $game_id){
        $validator = Validator::make($request->only('column'), [
            'column'=> 'required|int|min:1|max:9'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $user = Auth::user();
        $game = Game::where('id', $game_id)->first();
        $user_column = UserColumn::where('id', $game->user_column_id)->first();
        $opponent_column = OpponentColumn::where('id', $game->opponent_column_id)->first();

        //some data
        $user_data;
        $user_data['kazan'] = $user_column->kazan;
        $opponent_data;
        $opponent_data['kazan'] = $opponent_column->kazan;
        $sphere_number = 0;
        $user_tuzdyk_id = 0;
        $opponent_tuzdyk_id = 0;
        //пробегаюсь по всем колонкам of user
        if($user_column['first_column'] == -1){
            $user_tuzdyk_id = 1;
        }else if($user_column['second_column'] == -1){
            $user_tuzdyk_id = 2;
        }else if($user_column['three_column'] == -1){
            $user_tuzdyk_id = 3;
        }else if($user_column['four_column'] == -1){
            $user_tuzdyk_id = 4;
        }else if($user_column['five_column'] == -1){
            $user_tuzdyk_id = 5;
        }else if($user_column['six_column'] == -1){
            $user_tuzdyk_id = 6;
        }else if($user_column['seven_column'] == -1){
            $user_tuzdyk_id = 7;
        }else if($user_column['eight_column'] == -1){
            $user_tuzdyk_id = 8;
        }else if($user_column['nine_column'] == -1){
            $user_tuzdyk_id = 9;
        }
        //пробегаюсь по всем колонкам of opponent
        if($opponent_column['first_column'] == -1){
            $opponent_tuzdyk_id = 1;
        }else if($opponent_column['second_column'] == -1){
            $opponent_tuzdyk_id = 2;
        }else if($opponent_column['three_column'] == -1){
            $opponent_tuzdyk_id = 3;
        }else if($opponent_column['four_column'] == -1){
            $opponent_tuzdyk_id = 4;
        }else if($opponent_column['five_column'] == -1){
            $opponent_tuzdyk_id = 5;
        }else if($opponent_column['six_column'] == -1){
            $opponent_tuzdyk_id = 6;
        }else if($opponent_column['seven_column'] == -1){
            $opponent_tuzdyk_id = 7;
        }else if($opponent_column['eight_column'] == -1){
            $opponent_tuzdyk_id = 8;
        }else if($opponent_column['nine_column'] == -1){
            $opponent_tuzdyk_id = 9;
        }

        //first column logic
        
        if($request->column == 1){
            $sphere_number = $user_column->first_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['second_column' => $user_column->second_column + 1, 'first_column' => 0]);
                $game->update(['move'=> 1]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['first_column'] = 1;
            }
            
        }
        
        else if($request->column == 2){
            $sphere_number = $user_column->second_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['three_column' => $user_column->three_column + 1, 'second_column' => 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                $game->update(['move'=> 1]);
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['second_column'] = 1;
            }
        }
        
        else if($request->column == 3){
            $sphere_number = $user_column->three_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['four_column' => $user_column->four_column + 1, 'three_column' => 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                $game->update(['move'=> 1]);
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['three_column'] = 1;
            }
        }
        
        else if($request->column == 4){
            $sphere_number = $user_column->four_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['five_column' => $user_column->five_column + 1, 'four_column' => 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                $game->update(['move'=> 1]);
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['four_column'] = 1;
            }
        }
        
        else if($request->column == 5){
            $sphere_number = $user_column->five_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['six_column' => $user_column->six_column + 1, 'five_column' => 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                $game->update(['move'=> 1]);
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['five_column'] = 1;
            }
        }
        
        else if($request->column == 6){
            $sphere_number = $user_column->six_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['seven_column' => $user_column->seven_column + 1, 'six_column' => 0]);
                $game->update(['move'=> 1]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['six_column'] = 1;
            }
        }
        
        else if($request->column == 7){
            $sphere_number = $user_column->seven_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['eight_column' => $user_column->eight_column + 1, 'seven_column' => 0]);
                $game->update(['move'=> 1]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['seven_column'] = 1;
            }
        }
        
        else if($request->column == 8){
            $sphere_number = $user_column->eight_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['nine_column' => $user_column->nine_column + 1, 'eight_column' => 0]);
                $game->update(['move'=> 1]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['eight_column'] = 1;
            }
        }
        
        else if($request->column == 9){
            $sphere_number = $user_column->nine_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['nine_column' => 0]);
                $opponent_column->update(['first_column' => $opponent_column->first_column + 1]);
                $game->update(['move'=> 1]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['nine_column'] = 1;
            }
        }
        
        $is_return = false;
        $return_columns = 0;
        $user_columns_count_end = $request->column + $sphere_number;
        $opponent_columns_count = 0;
        $is_return = false;
        $return_columns = 0;
        if($user_columns_count_end > 10 && $sphere_number < 19){
            $opponent_columns_count = $user_columns_count_end - 9;
        }else if($sphere_number > 19){
            $is_return = true;
            $opponent_columns_count = 9;
            $return_columns = $opponent_columns_count - 9;
        }

        //logic of another user columns
        for ($i= $request->column + 1; $i < $user_columns_count_end; $i++) {
            $sphere_number--;
            if($i == 1){
                
                if($opponent_tuzdyk_id == 1){
                    $opponent_data['kazan'] = $user_data['first_column'];
                }else{
                    $user_data['first_column'] = $user_column->first_column + 1;
                }
            }
            
            else if($i == 2){
               
                if($opponent_tuzdyk_id == 2){
                    $opponent_data['kazan'] = $user_data['second_column'];
                }else{
                    $user_data['second_column'] = $user_column->second_column + 1;
                }
            }
            
            else if($i == 3){
               
                if($opponent_tuzdyk_id == 3){
                    $opponent_data['kazan'] = $user_data['three_column'];
                    $user_data['three_column'] = 0;
                }else{
                    $user_data['three_column'] = $user_column->three_column + 1;
                }
            }
            
            else if($i == 4){
                
                if($opponent_tuzdyk_id == 4){
                    $opponent_data['kazan'] = $user_data['four_column'];
                }else{
                    $user_data['four_column'] = $user_column->four_column + 1;
                }
            }
            
            else if($i == 5){
                
                if($opponent_tuzdyk_id == 5){
                    $opponent_data['kazan'] = $user_data['five_column'];
                }else{
                    $user_data['five_column'] = $user_column->five_column + 1;
                }
            }
            
            else if($i == 6){
                
                if($opponent_tuzdyk_id == 6){
                    $opponent_data['kazan'] = $user_data['six_column'];
                }else{
                    $user_data['six_column'] = $user_column->six_column + 1;
                }
            }
            
            else if($i == 7){
                
                if($opponent_tuzdyk_id == 7){
                    $opponent_data['kazan'] = $user_data['seven_column'];
                }else{
                    $user_data['seven_column'] = $user_column->seven_column + 1;
                }
            }
            
            else if($i == 8){
               
                if($opponent_tuzdyk_id == 8){
                    $opponent_data['kazan'] = $user_data['eight_column'];
                }else{
                    $user_data['eight_column'] = $user_column->eight_column + 1;
                }
            }
            
            else if($i == 9){
                
                if($opponent_tuzdyk_id == 9){
                    $opponent_data['kazan'] = $user_data['nine_column'];
                }else{
                    $user_data['nine_column'] = $user_column->nine_column + 1;
                }
            }
        }

        //logic of opponent columns
        if($opponent_columns_count != 0){

            for ($i= 1; $i < $opponent_columns_count + 1; $i++) {
                $sphere_number--;
                if($i == 1){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['first_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['first_column'] = $opponent_column->first_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['first_column'] % 2 == 0 && $opponent_data['first_column'] != 0){

                            $user_data['kazan'] = $opponent_data['first_column'] + $user_data['kazan'];
                            $opponent_data['first_column'] = 0;
                        }else if($opponent_data['first_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['first_column'] + $user_data['kazan'];
                            $opponent_data['first_column'] = -1;
                        }


                    }
                }
                
                else if($i == 2){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['second_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['second_column'] = $opponent_column->second_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['second_column'] % 2 == 0 && $opponent_data['second_column'] != 0){

                            $user_data['kazan'] = $opponent_data['second_column'] + $user_data['kazan'];
                            $opponent_data['second_column'] = 0;
                        }else if($opponent_data['second_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['second_column'] + $user_data['kazan'];
                            $opponent_data['second_column'] = -1;
                        }


                    }
                }
                
                else if($i == 3){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['three_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['three_column'] = $opponent_column->three_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['three_column'] % 2 == 0 && $opponent_data['three_column'] != 0){

                            $user_data['kazan'] = $opponent_data['three_column'] + $user_data['kazan'];
                            $opponent_data['three_column'] = 0;
                        }else if($opponent_data['three_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['three_column'] + $user_data['kazan'];
                            $opponent_data['three_column'] = -1;
                        }


                    }
                }
                
                else if($i == 4){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['four_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['four_column'] = $opponent_column->four_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['four_column'] % 2 == 0 && $opponent_data['four_column'] != 0){

                            $user_data['kazan'] = $opponent_data['four_column'] + $user_data['kazan'];
                            $opponent_data['four_column'] = 0;
                        }else if($opponent_data['four_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['four_column'] + $user_data['kazan'];
                            $opponent_data['four_column'] = -1;
                        }


                    }
                }
                
                else if($i == 5){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['five_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['five_column'] = $opponent_column->five_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['five_column'] % 2 == 0 && $opponent_data['five_column'] != 0){

                            $user_data['kazan'] = $opponent_data['five_column'] + $user_data['kazan'];
                            $opponent_data['five_column'] = 0;
                        }else if($opponent_data['five_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['five_column'] + $user_data['kazan'];
                            $opponent_data['five_column'] = -1;
                        }


                    }
                }
                
                else if($i == 6){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['six_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['six_column'] = $opponent_column->six_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['six_column'] % 2 == 0 && $opponent_data['six_column'] != 0){

                            $user_data['kazan'] = $opponent_data['six_column'] + $user_data['kazan'];
                            $opponent_data['six_column'] = 0;
                        }else if($opponent_data['six_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['six_column'] + $user_data['kazan'];
                            $opponent_data['six_column'] = -1;
                        }


                    }
                }
                
                else if($i == 7){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['seven_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['seven_column'] = $opponent_column->seven_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['seven_column'] % 2 == 0 && $opponent_data['seven_column'] != 0){

                            $user_data['kazan'] = $opponent_data['seven_column'] + $user_data['kazan'];
                            $opponent_data['seven_column'] = 0;
                        }else if($opponent_data['seven_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['seven_column'] + $user_data['kazan'];
                            $opponent_data['seven_column'] = -1;
                        }


                    }
                }
                
                else if($i == 8){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['eight_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['eight_column'] = $opponent_column->eight_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['eight_column'] % 2 == 0 && $opponent_data['eight_column'] != 0){

                            $user_data['kazan'] = $opponent_data['eight_column'] + $user_data['kazan'];
                            $opponent_data['eight_column'] = 0;
                        }else if($opponent_data['eight_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['eight_column'] + $user_data['kazan'];
                            $opponent_data['eight_column'] = -1;
                        }


                    }
                }
                
                else if($i == 9){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['nine_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['nine_column'] = $opponent_column->nine_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['nine_column'] % 2 == 0 && $opponent_data['nine_column'] != 0){

                            $user_data['kazan'] = $opponent_data['nine_column'] + $user_data['kazan'];
                            $opponent_data['nine_column'] = 0;
                        }else if($opponent_data['nine_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['nine_column'] + $user_data['kazan'];
                            $opponent_data['nine_column'] = -1;
                        }


                    }
                }

            }

            $opponent_column->update($opponent_data);
        }

        // заход на свою половину если остались шарики
        if($is_return){
            for ($i= 1; $i < $return_columns + 1; $i++) {
                if($i == 1){
                    
                    if($opponent_tuzdyk_id == 1){
                        $opponent_data['kazan'] = $user_data['first_column'];
                    }else{
                        $user_data['first_column']++;
                    }
                }
                
                else if($i == 2){
                   
                    if($opponent_tuzdyk_id == 2){
                        $opponent_data['kazan'] = $user_data['second_column'];
                    }else{
                        $user_data['second_column']++;
                    }
                }
                
                else if($i == 3){
                   
                    if($opponent_tuzdyk_id == 3){
                        $opponent_data['kazan'] = $user_data['three_column'];
                        $user_data['three_column'] = 0;
                    }else{
                        $user_data['three_column']++;
                    }
                }
                
                else if($i == 4){
                    
                    if($opponent_tuzdyk_id == 4){
                        $opponent_data['kazan'] = $user_data['four_column'];
                    }else{
                        $user_data['four_column']++;
                    }
                }
                
                else if($i == 5){
                    
                    if($opponent_tuzdyk_id == 5){
                        $opponent_data['kazan'] = $user_data['five_column'];
                    }else{
                        $user_data['five_column']++;
                    }
                }
                
                else if($i == 6){
                    
                    if($opponent_tuzdyk_id == 6){
                        $opponent_data['kazan'] = $user_data['six_column'];
                    }else{
                        $user_data['six_column']++;
                    }
                }
                
                else if($i == 7){
                    
                    if($opponent_tuzdyk_id == 7){
                        $opponent_data['kazan'] = $user_data['seven_column'];
                    }else{
                        $user_data['seven_column']++;
                    }
                }
                
                else if($i == 8){
                   
                    if($opponent_tuzdyk_id == 8){
                        $opponent_data['kazan'] = $user_data['eight_column'];
                    }else{
                        $user_data['eight_column']++;
                    }
                }
                
                else if($i == 9){
                    
                    if($opponent_tuzdyk_id == 9){
                        $opponent_data['kazan'] = $user_data['nine_column'];
                    }else{
                        $user_data['nine_column']++;
                    }
                }
            }
        }


        //update columns
        $user_column->update($user_data);


        //updating move choice
        $game->update([
            "move" => 1
        ]);
        $user_total = 0;
        $opponent_total = 0;
        //end of game
        if($user_column['first_column'] == 0 && $user_column['second_column'] == 0 && $user_column['three_column'] == 0 && $user_column['four_column'] == 0 && $user_column['five_column'] == 0 && $user_column['six_column'] == 0 && $user_column['seven_column'] == 0 && $user_column['eight_column'] == 0 && $user_column['nine_column'] == 0){
            $user_query = User::where('id', $game->user_id)->first();
            $opponent_query = User::where('id', $game->opponent_id)->first();
            //считаем сколько у юзера какашек
            $user_total += $user_column['first_column']; 
            $user_total += $user_column['second_column'];
            $user_total += $user_column['three_column']; 
            $user_total += $user_column['four_column'];  
            $user_total += $user_column['five_column']; 
            $user_total += $user_column['six_column']; 
            $user_total += $user_column['seven_column']; 
            $user_total += $user_column['eight_column']; 
            $user_total += $user_column['nine_column'];
            $user_total += $user_column['kazan'];
            //считаем сколько у опоненте какашек
            
            $opponent_total += $opponent_column['first_column']; 
            $opponent_total += $opponent_column['second_column'];
            $opponent_total += $opponent_column['three_column']; 
            $opponent_total += $opponent_column['four_column'];  
            $opponent_total += $opponent_column['five_column']; 
            $opponent_total += $opponent_column['six_column']; 
            $opponent_total += $opponent_column['seven_column']; 
            $opponent_total += $opponent_column['eight_column']; 
            $opponent_total += $opponent_column['nine_column'];
            $opponent_total += $opponent_column['kazan'];
            //user win
            if($user_total > $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                $user_query->update(['wins' => $user_query->wins + 1]);
                if($opponent_query->loses != 0){
                    $opponent_query->update(['loses' => $opponent_query->loses - 1]);
                }
                return response()->json(['game_status'=>'game end', 'winner'=> 'user'],200);

            }else if($user_total < $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                $opponent_query->update(['wins' => $opponent_query->wins + 1]);
                if($user_query->loses != 0){
                    $user_query->update(['loses' => $user_query->loses - 1]);
                }
                return response()->json(['game_status'=>'game end', 'winner'=> 'opponent'],200);
            }else if($user_total == $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                return response()->json(['game_status'=>'game end', 'winner'=> 'surrender'],200);
            }
        }else if($opponent_column['first_column'] == 0 && $opponent_column['second_column'] == 0 && $opponent_column['three_column'] == 0 && $opponent_column['four_column'] == 0 && $opponent_column['five_column'] == 0 && $opponent_column['six_column'] == 0 && $opponent_column['seven_column'] == 0 && $opponent_column['eight_column'] == 0 && $opponent_column['nine_column'] == 0){
            $user_query = User::where('id', $game->user_id)->first();
            $opponent_query = User::where('id', $game->opponent_id)->first();
            //считаем сколько у юзера какашек
            $user_total += $user_column['first_column']; 
            $user_total += $user_column['second_column'];
            $user_total += $user_column['three_column']; 
            $user_total += $user_column['four_column'];  
            $user_total += $user_column['five_column']; 
            $user_total += $user_column['six_column']; 
            $user_total += $user_column['seven_column']; 
            $user_total += $user_column['eight_column']; 
            $user_total += $user_column['nine_column'];
            $user_total += $user_column['kazan'];
            //считаем сколько у опоненте какашек
            
            $opponent_total += $opponent_column['first_column']; 
            $opponent_total += $opponent_column['second_column'];
            $opponent_total += $opponent_column['three_column']; 
            $opponent_total += $opponent_column['four_column'];  
            $opponent_total += $opponent_column['five_column']; 
            $opponent_total += $opponent_column['six_column']; 
            $opponent_total += $opponent_column['seven_column']; 
            $opponent_total += $opponent_column['eight_column']; 
            $opponent_total += $opponent_column['nine_column'];
            $opponent_total += $opponent_column['kazan'];
            //user win
            if($user_total > $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                $user_query->update(['wins' => $user_query->wins + 1]);
                if($opponent_query->loses != 0){
                    $opponent_query->update(['loses' => $opponent_query->loses - 1]);
                }
                return response()->json(['game_status'=>'game end', 'winner'=> 'user'],200);

            }else if($user_total < $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                $opponent_query->update(['wins' => $opponent_query->wins + 1]);
                if($user_query->loses != 0){
                    $user_query->update(['loses' => $user_query->loses - 1]);
                }
                return response()->json(['game_status'=>'game end', 'winner'=> 'opponent'],200);
            }else if($user_total == $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                return response()->json(['game_status'=>'game end', 'winner'=> 'surrender'],200);
            }
        }
        $updated_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
        return response()->json($updated_game,200);
    }    
    
    
    
    
    
    public function opponentMove(Request $request, $game_id){
        $validator = Validator::make($request->only('column'), [
            'column'=> 'required|int|min:1|max:9'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $user = Auth::user();
        $game = Game::where('id', $game_id)->first();
        $opponent_column = UserColumn::where('id', $game->user_column_id)->first();
        $user_column = OpponentColumn::where('id', $game->opponent_column_id)->first();

        //some data
        $user_data;
        $user_data['kazan'] = $user_column->kazan;
        $opponent_data;
        $opponent_data['kazan'] = $opponent_column->kazan;
        $sphere_number = 0;
        $user_tuzdyk_id = 0;
        $opponent_tuzdyk_id = 0;
        //пробегаюсь по всем колонкам of user
        if($user_column['first_column'] == -1){
            $user_tuzdyk_id = 1;
        }else if($user_column['second_column'] == -1){
            $user_tuzdyk_id = 2;
        }else if($user_column['three_column'] == -1){
            $user_tuzdyk_id = 3;
        }else if($user_column['four_column'] == -1){
            $user_tuzdyk_id = 4;
        }else if($user_column['five_column'] == -1){
            $user_tuzdyk_id = 5;
        }else if($user_column['six_column'] == -1){
            $user_tuzdyk_id = 6;
        }else if($user_column['seven_column'] == -1){
            $user_tuzdyk_id = 7;
        }else if($user_column['eight_column'] == -1){
            $user_tuzdyk_id = 8;
        }else if($user_column['nine_column'] == -1){
            $user_tuzdyk_id = 9;
        }
        //пробегаюсь по всем колонкам of opponent
        if($opponent_column['first_column'] == -1){
            $opponent_tuzdyk_id = 1;
        }else if($opponent_column['second_column'] == -1){
            $opponent_tuzdyk_id = 2;
        }else if($opponent_column['three_column'] == -1){
            $opponent_tuzdyk_id = 3;
        }else if($opponent_column['four_column'] == -1){
            $opponent_tuzdyk_id = 4;
        }else if($opponent_column['five_column'] == -1){
            $opponent_tuzdyk_id = 5;
        }else if($opponent_column['six_column'] == -1){
            $opponent_tuzdyk_id = 6;
        }else if($opponent_column['seven_column'] == -1){
            $opponent_tuzdyk_id = 7;
        }else if($opponent_column['eight_column'] == -1){
            $opponent_tuzdyk_id = 8;
        }else if($opponent_column['nine_column'] == -1){
            $opponent_tuzdyk_id = 9;
        }

        //first column logic
        if($request->column == 1){
            $sphere_number = $user_column->first_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['second_column' => $user_column->second_column + 1, 'first_column' => 0]);
                $game->update(['move'=> 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['first_column'] = 1;
            }
            
        }
        
        else if($request->column == 2){
            $sphere_number = $user_column->second_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['three_column' => $user_column->three_column + 1, 'second_column' => 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                $game->update(['move'=> 0]);
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['second_column'] = 1;
            }
        }
        
        else if($request->column == 3){
            $sphere_number = $user_column->three_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['four_column' => $user_column->four_column + 1, 'three_column' => 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                $game->update(['move'=> 0]);
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['three_column'] = 1;
            }
        }
        
        else if($request->column == 4){
            $sphere_number = $user_column->four_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['five_column' => $user_column->five_column + 1, 'four_column' => 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                $game->update(['move'=> 0]);
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['four_column'] = 1;
            }
        }
        
        else if($request->column == 5){
            $sphere_number = $user_column->five_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['six_column' => $user_column->six_column + 1, 'five_column' => 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                $game->update(['move'=> 0]);
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['five_column'] = 1;
            }
        }
        
        else if($request->column == 6){
            $sphere_number = $user_column->six_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['seven_column' => $user_column->seven_column + 1, 'six_column' => 0]);
                $game->update(['move'=> 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['six_column'] = 1;
            }
        }
        
        else if($request->column == 7){
            $sphere_number = $user_column->seven_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['eight_column' => $user_column->eight_column + 1, 'seven_column' => 0]);
                $game->update(['move'=> 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['seven_column'] = 1;
            }
        }
        
        else if($request->column == 8){
            $sphere_number = $user_column->eight_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['nine_column' => $user_column->nine_column + 1, 'eight_column' => 0]);
                $game->update(['move'=> 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['eight_column'] = 1;
            }
        }
        
        else if($request->column == 9){
            $sphere_number = $user_column->nine_column;
            //if 1 sphere on column logic
            if($sphere_number == 1){
                $user_column->update(['nine_column' => 0]);
                $opponent_column->update(['first_column' => $opponent_column->first_column + 1]);
                $game->update(['move'=> 0]);
                $started_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
                return response()->json($started_game,200);
            }else if($sphere_number == 0){
                return response()->json("Вы не можете ходить данным полем",300);
            }else{
                $user_data['nine_column'] = 1;
            }
        }
        
        $user_columns_count_end = $request->column + $sphere_number;
        $opponent_columns_count = 0;
        $is_return = false;
        $return_columns = 0;
        if($user_columns_count_end > 10 && $sphere_number < 19){
            $opponent_columns_count = $user_columns_count_end - 9;
        }else if($sphere_number > 19){
            $is_return = true;
            $opponent_columns_count = 9;
            $return_columns = $opponent_columns_count - 9;
        }

        //logic of another user columns
        for ($i= $request->column + 1; $i < $user_columns_count_end; $i++) {
            $sphere_number--;
            if($i == 1){
                
                if($opponent_tuzdyk_id == 1){
                    $opponent_data['kazan'] = $user_data['first_column'];
                }else{
                    $user_data['first_column'] = $user_column->first_column + 1;
                }
            }
            
            else if($i == 2){
               
                if($opponent_tuzdyk_id == 2){
                    $opponent_data['kazan'] = $user_data['second_column'];
                }else{
                    $user_data['second_column'] = $user_column->second_column + 1;
                }
            }
            
            else if($i == 3){
               
                if($opponent_tuzdyk_id == 3){
                    $opponent_data['kazan'] = $user_data['three_column'];
                    $user_data['three_column'] = 0;
                }else{
                    $user_data['three_column'] = $user_column->three_column + 1;
                }
            }
            
            else if($i == 4){
                
                if($opponent_tuzdyk_id == 4){
                    $opponent_data['kazan'] = $user_data['four_column'];
                }else{
                    $user_data['four_column'] = $user_column->four_column + 1;
                }
            }
            
            else if($i == 5){
                
                if($opponent_tuzdyk_id == 5){
                    $opponent_data['kazan'] = $user_data['five_column'];
                }else{
                    $user_data['five_column'] = $user_column->five_column + 1;
                }
            }
            
            else if($i == 6){
                
                if($opponent_tuzdyk_id == 6){
                    $opponent_data['kazan'] = $user_data['six_column'];
                }else{
                    $user_data['six_column'] = $user_column->six_column + 1;
                }
            }
            
            else if($i == 7){
                
                if($opponent_tuzdyk_id == 7){
                    $opponent_data['kazan'] = $user_data['seven_column'];
                }else{
                    $user_data['seven_column'] = $user_column->seven_column + 1;
                }
            }
            
            else if($i == 8){
               
                if($opponent_tuzdyk_id == 8){
                    $opponent_data['kazan'] = $user_data['eight_column'];
                }else{
                    $user_data['eight_column'] = $user_column->eight_column + 1;
                }
            }
            
            else if($i == 9){
                
                if($opponent_tuzdyk_id == 9){
                    $opponent_data['kazan'] = $user_data['nine_column'];
                }else{
                    $user_data['nine_column'] = $user_column->nine_column + 1;
                }
            }
        }

        //logic of opponent columns
        if($opponent_columns_count != 0){

            for ($i= 1; $i < $opponent_columns_count + 1; $i++) {
                $sphere_number--;
                if($i == 1){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['first_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['first_column'] = $opponent_column->first_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['first_column'] % 2 == 0 && $opponent_data['first_column'] != 0){

                            $user_data['kazan'] = $opponent_data['first_column'] + $user_data['kazan'];
                            $opponent_data['first_column'] = 0;
                        }else if($opponent_data['first_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['first_column'] + $user_data['kazan'];
                            $opponent_data['first_column'] = -1;
                        }


                    }
                }
                
                else if($i == 2){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['second_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['second_column'] = $opponent_column->second_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['second_column'] % 2 == 0 && $opponent_data['second_column'] != 0){

                            $user_data['kazan'] = $opponent_data['second_column'] + $user_data['kazan'];
                            $opponent_data['second_column'] = 0;
                        }else if($opponent_data['second_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['second_column'] + $user_data['kazan'];
                            $opponent_data['second_column'] = -1;
                        }


                    }
                }
                
                else if($i == 3){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['three_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['three_column'] = $opponent_column->three_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['three_column'] % 2 == 0 && $opponent_data['three_column'] != 0){

                            $user_data['kazan'] = $opponent_data['three_column'] + $user_data['kazan'];
                            $opponent_data['three_column'] = 0;
                        }else if($opponent_data['three_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['three_column'] + $user_data['kazan'];
                            $opponent_data['three_column'] = -1;
                        }


                    }
                }
                
                else if($i == 4){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['four_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['four_column'] = $opponent_column->four_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['four_column'] % 2 == 0 && $opponent_data['four_column'] != 0){

                            $user_data['kazan'] = $opponent_data['four_column'] + $user_data['kazan'];
                            $opponent_data['four_column'] = 0;
                        }else if($opponent_data['four_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['four_column'] + $user_data['kazan'];
                            $opponent_data['four_column'] = -1;
                        }


                    }
                }
                
                else if($i == 5){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['five_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['five_column'] = $opponent_column->five_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['five_column'] % 2 == 0 && $opponent_data['five_column'] != 0){

                            $user_data['kazan'] = $opponent_data['five_column'] + $user_data['kazan'];
                            $opponent_data['five_column'] = 0;
                        }else if($opponent_data['five_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['five_column'] + $user_data['kazan'];
                            $opponent_data['five_column'] = -1;
                        }


                    }
                }
                
                else if($i == 6){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['six_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['six_column'] = $opponent_column->six_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['six_column'] % 2 == 0 && $opponent_data['six_column'] != 0){

                            $user_data['kazan'] = $opponent_data['six_column'] + $user_data['kazan'];
                            $opponent_data['six_column'] = 0;
                        }else if($opponent_data['six_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['six_column'] + $user_data['kazan'];
                            $opponent_data['six_column'] = -1;
                        }


                    }
                }
                
                else if($i == 7){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['seven_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['seven_column'] = $opponent_column->seven_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['seven_column'] % 2 == 0 && $opponent_data['seven_column'] != 0){

                            $user_data['kazan'] = $opponent_data['seven_column'] + $user_data['kazan'];
                            $opponent_data['seven_column'] = 0;
                        }else if($opponent_data['seven_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['seven_column'] + $user_data['kazan'];
                            $opponent_data['seven_column'] = -1;
                        }


                    }
                }
                
                else if($i == 8){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['eight_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['eight_column'] = $opponent_column->eight_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['eight_column'] % 2 == 0 && $opponent_data['eight_column'] != 0){

                            $user_data['kazan'] = $opponent_data['eight_column'] + $user_data['kazan'];
                            $opponent_data['eight_column'] = 0;
                        }else if($opponent_data['eight_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['eight_column'] + $user_data['kazan'];
                            $opponent_data['eight_column'] = -1;
                        }


                    }
                }
                
                else if($i == 9){
                    if($user_tuzdyk_id == $i){
                        $user_data['kazan'] = $opponent_data['nine_column'] + $user_data['kazan'];
                    }else{
                        $opponent_data['nine_column'] = $opponent_column->nine_column + 1;
                    }
                    if($i == $opponent_columns_count){
                        if($opponent_data['nine_column'] % 2 == 0 && $opponent_data['nine_column'] != 0){

                            $user_data['kazan'] = $opponent_data['nine_column'] + $user_data['kazan'];
                            $opponent_data['nine_column'] = 0;
                        }else if($opponent_data['nine_column'] == 3 && $i != $opponent_tuzdyk_id){

                            $user_data['kazan'] = $opponent_data['nine_column'] + $user_data['kazan'];
                            $opponent_data['nine_column'] = -1;
                        }


                    }
                }

            }

            $opponent_column->update($opponent_data);
        }

        // заход на свою половину если остались шарики
        if($is_return){
            for ($i= 1; $i < $return_columns + 1; $i++) {
                if($i == 1){
                    
                    if($opponent_tuzdyk_id == 1){
                        $opponent_data['kazan'] = $user_data['first_column'];
                    }else{
                        $user_data['first_column']++;
                    }
                }
                
                else if($i == 2){
                   
                    if($opponent_tuzdyk_id == 2){
                        $opponent_data['kazan'] = $user_data['second_column'];
                    }else{
                        $user_data['second_column']++;
                    }
                }
                
                else if($i == 3){
                   
                    if($opponent_tuzdyk_id == 3){
                        $opponent_data['kazan'] = $user_data['three_column'];
                        $user_data['three_column'] = 0;
                    }else{
                        $user_data['three_column']++;
                    }
                }
                
                else if($i == 4){
                    
                    if($opponent_tuzdyk_id == 4){
                        $opponent_data['kazan'] = $user_data['four_column'];
                    }else{
                        $user_data['four_column']++;
                    }
                }
                
                else if($i == 5){
                    
                    if($opponent_tuzdyk_id == 5){
                        $opponent_data['kazan'] = $user_data['five_column'];
                    }else{
                        $user_data['five_column']++;
                    }
                }
                
                else if($i == 6){
                    
                    if($opponent_tuzdyk_id == 6){
                        $opponent_data['kazan'] = $user_data['six_column'];
                    }else{
                        $user_data['six_column']++;
                    }
                }
                
                else if($i == 7){
                    
                    if($opponent_tuzdyk_id == 7){
                        $opponent_data['kazan'] = $user_data['seven_column'];
                    }else{
                        $user_data['seven_column']++;
                    }
                }
                
                else if($i == 8){
                   
                    if($opponent_tuzdyk_id == 8){
                        $opponent_data['kazan'] = $user_data['eight_column'];
                    }else{
                        $user_data['eight_column']++;
                    }
                }
                
                else if($i == 9){
                    
                    if($opponent_tuzdyk_id == 9){
                        $opponent_data['kazan'] = $user_data['nine_column'];
                    }else{
                        $user_data['nine_column']++;
                    }
                }
            }
        }


        //update columns
        $user_column->update($user_data);


        //updating move choice
        $game->update([
            "move" => 0
        ]);
        $user_total = 0;
        $opponent_total = 0;
        //end of game
        if($user_column['first_column'] == 0 && $user_column['second_column'] == 0 && $user_column['three_column'] == 0 && $user_column['four_column'] == 0 && $user_column['five_column'] == 0 && $user_column['six_column'] == 0 && $user_column['seven_column'] == 0 && $user_column['eight_column'] == 0 && $user_column['nine_column'] == 0){
            $user_query = User::where('id', $game->user_id)->first();
            $opponent_query = User::where('id', $game->opponent_id)->first();
            //считаем сколько у юзера какашек
            $user_total += $user_column['first_column']; 
            $user_total += $user_column['second_column'];
            $user_total += $user_column['three_column']; 
            $user_total += $user_column['four_column'];  
            $user_total += $user_column['five_column']; 
            $user_total += $user_column['six_column']; 
            $user_total += $user_column['seven_column']; 
            $user_total += $user_column['eight_column']; 
            $user_total += $user_column['nine_column'];
            $user_total += $user_column['kazan'];
            //считаем сколько у опоненте какашек
            
            $opponent_total += $opponent_column['first_column']; 
            $opponent_total += $opponent_column['second_column'];
            $opponent_total += $opponent_column['three_column']; 
            $opponent_total += $opponent_column['four_column'];  
            $opponent_total += $opponent_column['five_column']; 
            $opponent_total += $opponent_column['six_column']; 
            $opponent_total += $opponent_column['seven_column']; 
            $opponent_total += $opponent_column['eight_column']; 
            $opponent_total += $opponent_column['nine_column'];
            $opponent_total += $opponent_column['kazan'];
            //user win
            if($user_total > $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                $user_query->update(['wins' => $user_query->wins + 1]);
                if($opponent_query->loses != 0){
                    $opponent_query->update(['loses' => $opponent_query->loses - 1]);
                }
                return response()->json(['game_status'=>'game end', 'winner'=> 'user'],200);

            }else if($user_total < $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                $opponent_query->update(['wins' => $opponent_query->wins + 1]);
                if($user_query->loses != 0){
                    $user_query->update(['loses' => $user_query->loses - 1]);
                }
                return response()->json(['game_status'=>'game end', 'winner'=> 'opponent'],200);
            }else if($user_total == $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                return response()->json(['game_status'=>'game end', 'winner'=> 'surrender'],200);
            }
        }else if($opponent_column['first_column'] == 0 && $opponent_column['second_column'] == 0 && $opponent_column['three_column'] == 0 && $opponent_column['four_column'] == 0 && $opponent_column['five_column'] == 0 && $opponent_column['six_column'] == 0 && $opponent_column['seven_column'] == 0 && $opponent_column['eight_column'] == 0 && $opponent_column['nine_column'] == 0){
            $user_query = User::where('id', $game->user_id)->first();
            $opponent_query = User::where('id', $game->opponent_id)->first();
            //считаем сколько у юзера какашек
            $user_total += $user_column['first_column']; 
            $user_total += $user_column['second_column'];
            $user_total += $user_column['three_column']; 
            $user_total += $user_column['four_column'];  
            $user_total += $user_column['five_column']; 
            $user_total += $user_column['six_column']; 
            $user_total += $user_column['seven_column']; 
            $user_total += $user_column['eight_column']; 
            $user_total += $user_column['nine_column'];
            $user_total += $user_column['kazan'];
            //считаем сколько у опоненте какашек
            
            $opponent_total += $opponent_column['first_column']; 
            $opponent_total += $opponent_column['second_column'];
            $opponent_total += $opponent_column['three_column']; 
            $opponent_total += $opponent_column['four_column'];  
            $opponent_total += $opponent_column['five_column']; 
            $opponent_total += $opponent_column['six_column']; 
            $opponent_total += $opponent_column['seven_column']; 
            $opponent_total += $opponent_column['eight_column']; 
            $opponent_total += $opponent_column['nine_column'];
            $opponent_total += $opponent_column['kazan'];
            //user win
            if($user_total > $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                $user_query->update(['wins' => $user_query->wins + 1]);
                if($opponent_query->loses != 0){
                    $opponent_query->update(['loses' => $opponent_query->loses - 1]);
                }
                return response()->json(['game_status'=>'game end', 'winner'=> 'user'],200);

            }else if($user_total < $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                $opponent_query->update(['wins' => $opponent_query->wins + 1]);
                if($user_query->loses != 0){
                    $user_query->update(['loses' => $user_query->loses - 1]);
                }
                return response()->json(['game_status'=>'game end', 'winner'=> 'opponent'],200);
            }else if($user_total == $opponent_total){
                $game->update(['game_status'=>'Игра завершилась']);
                return response()->json(['game_status'=>'game end', 'winner'=> 'surrender'],200);
            }
        }

        $updated_game = Game::where('id', $game->id)->with('user', 'opponent','user_column', 'opponent_column')->first();
        return response()->json($updated_game,200);
    }
}