<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    public $timestamps = true;
    protected $fillable = ['board', 'player', 'winner'];
}
