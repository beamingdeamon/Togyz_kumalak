<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','opponent_id','user_column_id','opponent_column_id','game_code','move','game_status'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function opponent(){
        return $this->belongsTo(User::class, 'opponent_id');
    }
    public function user_column(){
        return $this->belongsTo(UserColumn::class, 'user_column_id');
    }
    public function opponent_column(){
        return $this->belongsTo(OpponentColumn::class, 'opponent_column_id');
    }
}
