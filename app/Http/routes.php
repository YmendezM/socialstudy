<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 
	['as' => 'tickets.latest',
	'uses' => 'TicketsController@latest']);

Route::get('/populares', 
	['as' => 'tickets.popular', 
	'uses' => 'TicketsController@popular']);

Route::get('/pendientes', 
	['as' => 'tickets.open', 
	'uses' => 'TicketsController@open']);

Route::get('/tutoriales', 
	['as' => 'tickets.closed', 
	'uses' => 'TicketsController@closed']);

Route::get('/solicitud/{id}', 
	['as' => 'tickets.details', 
	'uses' => 'TicketsController@details']);
 


//Route::get('home', 'HomeController@index');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'auth'], function(){

	//Crear Solicitudes
	Route::get('/solicitar', [

		  'as' 	 => 'tickets.create',
		  'uses' => 'TicketsController@create' 

		]);

	Route::post('/solicitar',[
			'as'   => 'tickets.store',
			'uses' => 'TicketsController@store' 	

		]);

	//Votar

	Route::post('/votar/{id}', [
		 'as'   => 'vote.submit',
		 'uses' => 'VoteController@Submit'
  
		]);
	Route::delete('/votar/{id}', [
		 'as'   => 'vote.destroy',
		 'uses' => 'VoteController@destroy'
  
		]);

	// Comentar
	// Comentar/5
	// Comentar/10
	Route::post('/comment/{id}', [
		'as' => 'comment.create', 
		'uses' => 'CommentController@create']);

	Route::post('/ticketfinish/{id}/{comment}', [
		'as' => 'tickets.finish', 
		'uses' => 'TicketsController@finish']);

});
