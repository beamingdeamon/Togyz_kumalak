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
        $opponent_data;
        $sphere_number = 0;
        $user_tuzdyk_id = null;
        $opponent_tuzdyk_id = null;
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
            $user_data['first_column'] = 1;
            $sphere_number = $user_column->first_column;
        }
        
        else if($request->column == 2){
            $user_data['second_column'] = 1;
            $sphere_number = $user_column->second_column;
        }
        
        else if($request->column == 3){
            $user_data['three_column'] = 1;
            $sphere_number = $user_column->three_column;
        }
        
        else if($request->column == 4){
            $user_data['four_column'] = 1;
            $sphere_number = $user_column->four_column;
        }
        
        else if($request->column == 5){
            $user_data['five_column'] = 1;
            $sphere_number = $user_column->five_column;
        }
        
        else if($request->column == 6){
            $user_data['six_column'] = 1;
            $sphere_number = $user_column->six_column;
        }
        
        else if($request->column == 7){
            $user_data['seven_column'] = 1;
            $sphere_number = $user_column->seven_column;
        }
        
        else if($request->column == 8){
            $user_data['eight_column'] = 1;
            $sphere_number = $user_column->eight_column;
        }
        
        else if($request->column == 9){
            $user_data['nine_column'] = 1;
            $sphere_number = $user_column->nine_column;
        }
        
        $user_columns_count_end = $request->column + $sphere_number;
        $opponent_columns_count = 0;
        if($user_columns_count_end > 10){
            $opponent_columns_count = $user_columns_count_end - 9;
        }

        //logic of another user columns
        for ($i= $request->column + 1; $i < $user_columns_count_end; $i++) {
            if($i == 1){
                $user_data['first_column'] = $user_column->first_column + 1;
                if($opponent_tuzdyk_id == 1){
                    $opponent_data['kazan'] = $user_data['first_column'];
                    $user_data['first_column'] = 0;
                }
            }
            
            else if($i == 2){
                $user_data['second_column'] = $user_column->second_column + 1;
                if($opponent_tuzdyk_id == 2){
                    $opponent_data['kazan'] = $user_data['second_column'];
                    $user_data['second_column'] = 0;
                }
            }
            
            else if($i == 3){
                $user_data['three_column'] = $user_column->three_column + 1;
                if($opponent_tuzdyk_id == 3){
                    $opponent_data['kazan'] = $user_data['three_column'];
                    $user_data['three_column'] = 0;
                }
            }
            
            else if($i == 4){
                $user_data['four_column'] = $user_column->four_column + 1;
                if($opponent_tuzdyk_id == 4){
                    $opponent_data['kazan'] = $user_data['four_column'];
                    $user_data['four_column'] = 0;
                }
            }
            
            else if($i == 5){
                $user_data['five_column'] = $user_column->five_column + 1;
                if($opponent_tuzdyk_id == 5){
                    $opponent_data['kazan'] = $user_data['five_column'];
                    $user_data['five_column'] = 0;
                }
            }
            
            else if($i == 6){
                $user_data['six_column'] = $user_column->six_column + 1;
                if($opponent_tuzdyk_id == 6){
                    $opponent_data['kazan'] = $user_data['six_column'];
                    $user_data['six_column'] = 0;
                }
            }
            
            else if($i == 7){
                $user_data['seven_column'] = $user_column->seven_column + 1;
                if($opponent_tuzdyk_id == 7){
                    $opponent_data['kazan'] = $user_data['seven_column'];
                    $user_data['seven_column'] = 0;
                }
            }
            
            else if($i == 8){
                $user_data['eight_column'] = $user_column->eight_column + 1;
                if($opponent_tuzdyk_id == 8){
                    $opponent_data['kazan'] = $user_data['eight_column'];
                    $user_data['eight_column'] = 0;
                }
            }
            
            else if($i == 9){
                $user_data['nine_column'] = $user_column->nine_column + 1;
                if($opponent_tuzdyk_id == 9){
                    $opponent_data['kazan'] = $user_data['nine_column'];
                    $user_data['nine_column'] = 0;
                }
            }
        }

        //logic of opponent columns
        if($opponent_columns_count != 0){

            for ($i= 1; $i < $opponent_columns_count + 1; $i++) {
                if($i == 1){
                    $opponent_data['first_column'] = $opponent_column->first_column + 1;
                    if($i == $opponent_columns_count){
                        if($user_tuzdyk_id == $i){
                            $user_data['kazan'] = $opponent_data['first_column'] + $user_data['kazan'];
                            $opponent_data['first_column'] = 0;
                        }else if($opponent_data['first_column'] % 2 == 0){
                            $user_data['kazan'] = $opponent_data['first_column'] + $user_data['kazan'];
                            $opponent_data['first_column'] = 0;
                        }


                    }
                }
                
                else if($i == 2){
                    $opponent_data['second_column'] = $opponent_column->second_column + 1;
                    if($i == $opponent_columns_count){
                        if($user_tuzdyk_id == $i){
                            $user_data['kazan'] = $opponent_data['second_column'] + $user_data['kazan'];
                            $opponent_data['second_column'] = 0;
                        }else if($opponent_data['second_column'] % 2 == 0){
                            $user_data['kazan'] = $opponent_data['second_column']+ $user_data['kazan'];
                            $opponent_data['second_column'] = 0;
                        }
                    }
                }
                
                else if($i == 3){
                    $opponent_data['three_column'] = $opponent_column->three_column + 1;
                    if($i == $opponent_columns_count){
                        if($user_tuzdyk_id == $i){
                            $user_data['kazan'] = $opponent_data['three_column'] + $user_data['kazan'];
                            $opponent_data['three_column'] = 0;
                        }else if($opponent_data['three_column'] % 2 == 0){
                            $user_data['kazan'] = $opponent_data['three_column']+ $user_data['kazan'];
                            $opponent_data['three_column'] = 0;
                        }
                    }
                }
                
                else if($i == 4){
                    $opponent_data['four_column'] = $opponent_column->four_column + 1;
                    if($i == $opponent_columns_count){
                        if($user_tuzdyk_id == $i){
                            $user_data['kazan'] = $opponent_data['four_column'] + $user_data['kazan'];
                            $opponent_data['four_column'] = 0;
                        }else if($opponent_data['four_column'] % 2 == 0){
                            $user_data['kazan'] = $opponent_data['four_column']+ $user_data['kazan'];
                            $opponent_data['four_column'] = 0;
                        }
                    }
                }
                
                else if($i == 5){
                    $opponent_data['five_column'] = $opponent_column->five_column + 1;
                    if($i == $opponent_columns_count){
                        if($user_tuzdyk_id == $i){
                            $user_data['kazan'] = $opponent_data['five_column'] + $user_data['kazan'];
                            $opponent_data['five_column'] = 0;
                        }else if($opponent_data['five_column'] % 2 == 0){
                            $user_data['kazan'] = $opponent_data['five_column']+ $user_data['kazan'];
                            $opponent_data['five_column'] = 0;
                        }
                    }
                }
                
                else if($i == 6){
                    $opponent_data['six_column'] = $opponent_column->six_column + 1;
                    if($i == $opponent_columns_count ){
                        if($user_tuzdyk_id == $i){
                            $user_data['kazan'] = $opponent_data['six_column'] + $user_data['kazan'];
                            $opponent_data['six_column'] = 0;
                        }else if($opponent_data['six_column'] % 2 == 0){
                            $user_data['kazan'] = $opponent_data['six_column']+ $user_data['kazan'];
                            $opponent_data['six_column'] = 0;
                        }
                    }
                }
                
                else if($i == 7){
                    $opponent_data['seven_column'] = $opponent_column->seven_column + 1;
                    if($i == $opponent_columns_count ){
                        if($user_tuzdyk_id == $i){
                            $user_data['kazan'] = $opponent_data['seven_column'] + $user_data['kazan'];
                            $opponent_data['seven_column'] = 0;
                        }else if($opponent_data['seven_column'] % 2 == 0){
                            $user_data['kazan'] = $opponent_data['seven_column']+ $user_data['kazan'];
                            $opponent_data['seven_column'] = 0;
                        }
                    }
                }
                
                else if($i == 8){
                    $opponent_data['eight_column'] = $opponent_column->eight_column + 1;
                    if($i == $opponent_columns_count){
                        if($user_tuzdyk_id == $i){
                            $user_data['kazan'] = $opponent_data['eight_column'] + $user_data['kazan'];
                            $opponent_data['eight_column'] = 0;
                        }else if($opponent_data['eight_column'] % 2 == 0){
                            $user_data['kazan'] = $opponent_data['eight_column']+ $user_data['kazan'];
                            $opponent_data['eight_column'] = 0;
                        }
                    }
                }
                
                else if($i == 9){
                    $opponent_data['nine_column'] = $opponent_column->nine_column + 1;
                    if($i == $opponent_columns_count){
                        if($user_tuzdyk_id == $i){
                            $user_data['kazan'] = $opponent_data['nine_column'] + $user_data['kazan'];
                            $opponent_data['nine_column'] = 0;
                        }else if($opponent_data['nine_column'] % 2 == 0){
                            $user_data['kazan'] = $opponent_data['nine_column']+ $user_data['kazan'];
                            $opponent_data['nine_column'] = 0;
                        }
                    }
                }

            }

            $opponent_column->update($opponent_data);
        }
        //update columns
        $user_column->update($user_data);


        //updating move choice
        $game->update([
            "move" => 1
        ]);

        return response()->json($game,200);
    }
}
