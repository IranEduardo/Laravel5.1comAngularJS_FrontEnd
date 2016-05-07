<?php


Route::get('/', function () {
    return view('app');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth' ], function(){

    Route::get('client', ['as' => 'client', 'uses' => 'ClientController@index']);
    Route::post('client', ['as' => 'client.store', 'uses' => 'ClientController@store']);
    Route::get('client/{id}', ['as' => 'client.show', 'uses' => 'ClientController@show']);
    Route::put('client/{id}', ['as' => 'client.update', 'uses' => 'ClientController@update']);
    Route::delete('client/{id}', ['as' => 'client.destroy', 'uses' => 'ClientController@destroy']);

    Route::get('project/{id}/member', ['as' => 'project.index_members', 'uses' => 'ProjectController@index_members']);
    Route::post('project/member', ['as' => 'project.store_member',  'uses' => 'ProjectController@store_member']);
    Route::delete('project/{id}/member/{idUser}', ['as' => 'project.destroy_member', 'uses' => 'ProjectController@destroy_member']);

    Route::get('project', ['as' => 'project', 'uses' => 'ProjectController@index']);
    Route::post('project', ['as' => 'project.store', 'uses' => 'ProjectController@store']);
    Route::get('project/{id}', ['as' => 'project.show', 'uses' => 'ProjectController@show']);
    Route::put('project/{id}', ['as' => 'project.update', 'uses' => 'ProjectController@update']);
    Route::delete('project/{id}', ['as' => 'project.destroy', 'uses' => 'ProjectController@destroy']);

    Route::get('project/{id}/note', ['as' => 'projectnote.index', 'uses' => 'ProjectNoteController@index']);
    Route::post('project/note', ['as' => 'projectnote.store', 'uses' => 'ProjectNoteController@store']);
    Route::get('project/{id}/note/{idNote}', ['as' => 'projectnote.show', 'uses' => 'ProjectNoteController@show']);
    Route::put('project/note/{idNote}', ['as' => 'projectnote.update', 'uses' => 'ProjectNoteController@update']);
    Route::delete('project/note/{idNote}', ['as' => 'projectnote.destroy', 'uses' => 'ProjectNoteController@destroy']);

    Route::get('project/{id}/task', ['as' => 'projecttask.index', 'uses' => 'ProjectTaskController@index']);
    Route::post('project/task', ['as' => 'projecttask.store', 'uses' => 'ProjectTaskController@store']);
    Route::get('project/{id}/task/{idTask}', ['as' => 'projecttask.show', 'uses' => 'ProjectTaskController@show']);
    Route::put('project/task/{idTask}', ['as' => 'projecttask.update', 'uses' => 'ProjectTaskController@update']);
    Route::delete('project/task/{idTask}', ['as' => 'projecttask.destroy', 'uses' => 'ProjectTaskController@destroy']);


    Route::delete('project/{id}/projectfile/{idProjectFile}', ['as' => 'projectfile.destroy', 'uses' => 'ProjectFileController@destroy']);
    Route::post('project/projectfile', ['as' => 'projectfile.store', 'uses' => 'ProjectFileController@store']);

});




