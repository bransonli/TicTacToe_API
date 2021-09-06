<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Game;

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
    dd("this");

});

//Return games with specified ID 
Route::get('/games/{id}', function(){
    dd("this");

});



//Creating a game 
Route::post('/games', function(){
    $game = new Game;
    $game->board = "000000000";
    $game->winner = 0;
    $game->player = 1;
    $game->save();
    return $game->board;
});


//Playing  
Route::post('/games/{id}', function($id){
    $game = Game::find($id);

    

    $player = request()->input('player');
    $move = request()->input('move');
    $board = $game->board;


    //converting board to array
    $board = str_split($board, 3);
    $temp_arr_1 = str_split($board[0]);
    $temp_arr_2 = str_split($board[1]);
    $temp_arr_3 = str_split($board[2]);

    $board = array($temp_arr_1, $temp_arr_2, $temp_arr_3);

    //updating player in database 
    if ($player == 1){
        $game->player = 2;
    } elseif ($player == 2){
        $game->player = 1;
    }
        

    //processing input 
    $move = str_split($move);
    $col = (int)$move[0];
    $row = (int)$move[1];

    //Make a move 
    $board[$col][$row] = (int)$player;

    //Updting board in database 
    $temp_arr_1 = implode("", $board[0]); 
    $temp_arr_2 = implode("", $board[1]);
    $temp_arr_3 = implode("", $board[2]);
    $temp_arr_combined = implode("", $temp_arr_1, $temp_arr_2, $temp_arr_3);

    $string_board = implode("", $temp_arr_combined);
    $game->board = $string_board;



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

                $game->winner = $player;
                $game->save();
                return $game;
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
        }

        if ($counter == 3){

            $game->winner = $player;
            $game->save();
            return $game;
        }

    }

    //diagonal 

    if (($board[0][0] == 1 and $board[1][1] == 1 and $board[2][2] == 1) || ($board[0][2] == 1 and $board[1][1] == 1 and $board[2][0] == 1 )){
        $game->winner = $player;
        $game->save();
        return $game;
    } elseif (($board[0][0] == 2 and $board[1][1] == 2 and $board[2][2] == 2) || ($board[0][2] == 2 and $board[1][1] == 2 and $board[2][0] == 2 )){
        $game->winner = $player;
        $game->save();
        return $game;
    }

    //still in progress
    for ($i =0; $i<3; $i+=1){
        for ($j = 0; $j<3; $j+=1){
            if ($board[$i][$j] == 0){
                $game->save();
                return $game;
            }
        } 
    }


    $game->winner = -1;
    $game->save();
    return $game;


});



