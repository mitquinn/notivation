<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::group(['prefix' => 'v1'], function() {
    	Route::get('notes/gettags/{note_id}', 'NotesController@gettags');
		Route::post('notes/addtag', 'NotesController@addtag');
		Route::delete('notes/removetag/{tag_id}', 'NotesController@removetag');
		Route::resource('notes','NotesController');
	});
});
