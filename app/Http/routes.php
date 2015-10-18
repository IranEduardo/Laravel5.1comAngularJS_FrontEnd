<?php


Route::get('/', function () {
    return view('welcome');
});



Route::get('client', ['as' => 'client', 'uses' => 'ClientController@index']);
Route::post('client', ['as' => 'client.store', 'uses' => 'ClientController@store']);
Route::get('client/{id}', ['as' => 'client.show', 'uses' => 'ClientController@show']);
Route::post('client/{id}', ['as' => 'client.update', 'uses' => 'ClientController@update']);
Route::delete('client/{id}', ['as' => 'client.destroy', 'uses' => 'ClientController@destroy']);


