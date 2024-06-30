<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team',
        'away_team',
        'match_time',
        'is_home_game',
        'tournament_name',
        'purchase_duration',
        'stadium_name',
        'status'
    ];
}
