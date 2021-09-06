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
    return Games::all();
});

//Return games with specified ID 
Route::get('/games/{id}', function($id){
    $games = Games::find($id);
    if (!$games) {
        return response()->json(['message' => 'Document not found'], 404)
    }
});



//
Route::post('/games', function(){


});


//Playing  
Route::post('/games/{id}', function($id){
    $player = request()->input('player');
    $move = request()->input('move');


});



