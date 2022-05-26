<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpponentColumn extends Model
{
    use HasFactory;
    protected $fillable = ['first_column', 'second_column','three_column','four_column','five_column','six_column','seven_column','eight_column','nine_column','kazan'];
}
