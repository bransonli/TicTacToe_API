<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Return all the games 
Route::get('/games', function(){

});

//Return games with specified ID 
Route::get('/games/{id}', function(){


});



//
Route::post('/games', function(){


});


//Playing  
Route::post('/games/{id}', function($id){
    $player = request()->input('player');
    $move = request()->input('move');
    $board //board in 2d array form 

    //processing input 
    $move = str_split($move);
    $col = (int)$move[0];
    $row = (int)$move[1];

    //Make a move 
    $board[$col][$row] = (int)$player


    //checking results 

    //horiztonal 
    for ($i =0; $i<3; $i+=1){
        $counter = 0; 
        $reference = $board[$i][1];

            for ($j = 0; $j<3; $j+=1){
                if ($board[$i][$j] != $reference) {
                    $reference = $board[$i][$j];
                } else {
                    $counter = $counter + 1;
                }
            }

            if ($counter == 3) {
                return $reference;
            }
    }

    //vertical 
    for ($i =0; $i<3; $i+=1){
        $counter = 0;
        $reference = $board[1][$i];
        for ($j = 0; $j<3; $j+=1){
            if ($board[$j][$i] != $reference){
                $reference = $board[$j][$i];

            } else {
                $counter = $counter + 1;
            }

        if ($counter == 3){
            return $reference;
        }

    }

    //diagonal 

    if (($board[0][0] == 1 and $board[1][1] == 1 and $board[2][2] == 1) or ($board[0][2] == 1 and $board[1][1] == 1 and $board[2][0] == 1 )){
        return 1;
    } elseif (($board[0][0] == 2 and $board[1][1] == 2 and $board[2][2] == 2) or ($board[0][2] == 2 and $board[1][1] == 2 and $board[2][0] == 2 )){
        return 2;
    }

    //still in progress
    for ($i =0; $i<3; $i+=1){
        for ($j = 0; $j<3; $j+=1){
            if ($board[$i][$j] == 0){
                return 0;
            }
        } 
    }


    return -1;


});



