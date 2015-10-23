<?php


Route::get('/', function () {
    return view('welcome');
});



Route::get('client', ['as' => 'client', 'uses' => 'ClientController@index']);
Route::post('client', ['as' => 'client.store', 'uses' => 'ClientController@store']);
Route::get('client/{id}', ['as' => 'client.show', 'uses' => 'ClientController@show']);
Route::put('client/{id}', ['as' => 'client.update', 'uses' => 'ClientController@update']);
Route::delete('client/{id}', ['as' => 'client.destroy', 'uses' => 'ClientController@destroy']);

Route::get('project', ['as' => 'project', 'uses' => 'ProjectController@index']);
Route::post('project', ['as' => 'project.store', 'uses' => 'ProjectController@store']);
Route::get('project/{id}', ['as' => 'project.show', 'uses' => 'ProjectController@show']);
Route::put('project/{id}', ['as' => 'project.update', 'uses' => 'ProjectController@update']);
Route::delete('project/{id}', ['as' => 'project.destroy', 'uses' => 'ProjectController@destroy']);
