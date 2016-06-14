<?php


Route::get('/', function () {
    return view('app');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth' ], function(){

    Route::resource('project', 'ProjectController', ['except' => ['create', 'edit']]);

    Route::get('client', ['as' => 'client', 'uses' => 'ClientController@index']);
    Route::post('client', ['as' => 'client.store', 'uses' => 'ClientController@store']);
    Route::get('client/{id}', ['as' => 'client.show', 'uses' => 'ClientController@show']);
    Route::put('client/{id}', ['as' => 'client.update', 'uses' => 'ClientController@update']);
    Route::delete('client/{id}', ['as' => 'client.destroy', 'uses' => 'ClientController@destroy']);

    Route::group(['middleware' => 'check.project.permission' ], function() {

        Route::get('project/{id}/member', ['as' => 'projectmember.index', 'uses' => 'ProjectMemberController@index']);
        Route::post('project/{id}/member', ['as' => 'projectmember.store', 'uses' => 'ProjectMemberController@store']);
        Route::get('project/{id}/member/{idMember}', ['as' => 'projectmember.show', 'uses' => 'ProjectMemberController@show']);
        Route::put('project/{id}/member/{idMember}', ['as' => 'projectmember.update', 'uses' => 'ProjectMemberController@update']);
        Route::delete('project/{id}/member/{idMember}', ['as' => 'projectmember.destroy', 'uses' => 'ProjectMemberController@destroy']);

        /*Route::get('project', ['as' => 'project', 'uses' => 'ProjectController@index']);
        Route::post('project', ['as' => 'project.store', 'uses' => 'ProjectController@store']);
        Route::get('project/{id}', ['as' => 'project.show', 'uses' => 'ProjectController@show']);
        Route::put('project/{id}', ['as' => 'project.update', 'uses' => 'ProjectController@update']);
        Route::delete('project/{id}', ['as' => 'project.destroy', 'uses' => 'ProjectController@destroy']); */

        Route::get('project/{id}/note', ['as' => 'projectnote.index', 'uses' => 'ProjectNoteController@index']);
        Route::post('project/{id}/note', ['as' => 'projectnote.store', 'uses' => 'ProjectNoteController@store']);
        Route::get('project/{id}/note/{idNote}', ['as' => 'projectnote.show', 'uses' => 'ProjectNoteController@show']);
        Route::put('project/{id}/note/{idNote}', ['as' => 'projectnote.update', 'uses' => 'ProjectNoteController@update']);
        Route::delete('project/{id}/note/{idNote}', ['as' => 'projectnote.destroy', 'uses' => 'ProjectNoteController@destroy']);

        Route::get('project/{id}/task', ['as' => 'projecttask.index', 'uses' => 'ProjectTaskController@index']);
        Route::post('project/{id}/task', ['as' => 'projecttask.store', 'uses' => 'ProjectTaskController@store']);
        Route::get('project/{id}/task/{idTask}', ['as' => 'projecttask.show', 'uses' => 'ProjectTaskController@show']);
        Route::put('project/{id}/task/{idTask}', ['as' => 'projecttask.update', 'uses' => 'ProjectTaskController@update']);
        Route::delete('project/{id}/task/{idTask}', ['as' => 'projecttask.destroy', 'uses' => 'ProjectTaskController@destroy']);


        Route::delete('project/{id}/file/{idFile}', ['as' => 'projectfile.destroy', 'uses' => 'ProjectFileController@destroy']);
        Route::post('project/{id}/file', ['as' => 'projectfile.store', 'uses' => 'ProjectFileController@store']);
        Route::put('project/{id}/file/{idFile}', ['as' => 'projectfile.update', 'uses' => 'ProjectFileController@update']);
        Route::get('project/{id}/file/{idFile}', ['as' => 'projectfile.show', 'uses' => 'ProjectFileController@show']);
        Route::get('project/{id}/file', ['as' => 'projectfile.index', 'uses' => 'ProjectFileController@index']);
        Route::get('project/{id}/file/{idFile}/download', ['as' => 'projectfile.showFile', 'uses' => 'ProjectFileController@showFile']);
    });
    Route::get('user/authenticated', ['as' => 'user.authenticated', 'uses' => 'UserController@authenticated']);
});









