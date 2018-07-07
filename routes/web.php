<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix'=>'projetos'], function(){

	Route::get('/', 'ProjectController@index')->name('projects');
	Route::get('novo', 'ProjectController@create')->name('projects.create');
	Route::post('/', 'ProjectController@store')->name('projects.store');
	
	Route::group(['prefix' => '{project}', 'middleware' => 'checkAccessUserForProject'], function(){
		Route::get('/', 'ProjectController@show')->name('projects.show');
		Route::get('editar', 'ProjectController@edit')->name('projects.edit');
		Route::put('editar', 'ProjectController@update')->name('projects.update');
		Route::put('membros', 'ProjectController@members')->name('projects.members');
		Route::delete('/', 'ProjectController@destroy')->name('projects.destroy');

		Route::group(['prefix' => 'tarefas'], function(){
			
			Route::post('/', 'TaskController@store')->name('projects.tasks.store');
			Route::get('{task}', 'TaskController@show')->name('projects.tasks.show');
		});
		
	});

});

Route::group(['prefix'=>'usuarios'], function(){

	Route::get('convidar','UserController@invatationForm')->name('users.invite');
});