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
	Route::post('novo', 'ProjectController@store')->name('projects.store');
	
	Route::group(['prefix' => '{project}', 'middleware' => 'checkAccessUserForProject'], function(){
		
		Route::get('/', 'ProjectController@show')->name('projects.show');
		Route::put('editar', 'ProjectController@update')->name('projects.update');
		Route::put('membros', 'ProjectController@members')->name('projects.members');
		Route::patch('arquivar', 'ProjectController@delete')->name('projects.delete');
		Route::patch('restaurar', 'ProjectController@restore')->name('projects.restore');
		Route::delete('excluir', 'ProjectController@destroy')->name('projects.destroy');

		Route::group(['prefix' => 'tarefas'], function(){
			
			Route::get('/', 'TaskController@index')->name('projects.tasks');
			
			Route::post('criar', 'TaskController@store')->name('projects.tasks.store');

			Route::group(['prefix' => '{task}'], function(){
				
				Route::get('/', 'TaskController@show')->name('projects.tasks.show');
				Route::put('membros', 'TaskController@members')->name('projects.tasks.members');
				Route::put('editar', 'TaskController@update')->name('projects.tasks.update');
				Route::patch('arquivar', 'TaskController@delete')->name('projects.tasks.delete');
				Route::put('restaurar', 'TaskController@restore')->name('projects.tasks.restore');
				Route::delete('excluir', 'TaskController@destroy')->name('projects.tasks.destroy');
				

				Route::group(['prefix' => 'todos'], function(){
					Route::post('store', 'TodoController@store')->name('projects.tasks.todos.store');
					Route::group(['prefix' => '{todo}'], function(){

						Route::put('update', 'TodoController@update')->name('projects.tasks.todos.update');

					});

				});
			});
			
		});
		
	});

});

Route::group(['prefix'=>'usuarios'], function(){

	Route::get('convidar','UserController@invatationForm')->name('users.invite');

});

Route::group(['prefix'=>'lixeira'], function(){

	Route::get('/','TrashController@index')->name('trash');
	
});