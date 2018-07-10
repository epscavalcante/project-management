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

Route::group(['middleware' => 'auth'], function(){

	Route::get('/', 'HomeController@index')->name('home');
	Route::get('novo', 'ProjectController@create')->name('projects.create');
	Route::post('/', 'ProjectController@store')->name('projects.store');

	Route::group(['prefix' => '{project}', 'middleware' => 'checkAccessUserForProject'], function(){
		
		Route::get('/', 'ProjectController@show')->name('projects.show');
		Route::delete('/', 'ProjectController@destroy')->name('project.destroy');
		
		Route::group(['prefix' => 'editar'], function(){
			Route::get('/', 'ProjectController@edit')->name('projects.edit');
			Route::put('/', 'ProjectController@update')->name('projects.update');
		});

		Route::group(['prefix' => 'membros'], function(){
			Route::get('/', 'ProjectController@members')->name('projects.members');
		});

		Route::group(['prefix' => 'tarefas'], function(){
			Route::get('/', 'ProjectController@tasks')->name('projects.tasks');
			Route::post('/', 'TaskController@store')->name('projects.tasks.store');

			Route::group(['prefix' => '{task}'], function(){
				
				Route::get('/', 'TaskController@show')->name('projects.tasks.show');
				Route::put('editar', 'TaskController@update')->name('projects.tasks.update');
				Route::delete('excluir', 'TaskController@destroy')->name('projects.tasks.destroy');
				
				Route::group(['prefix' => 'todos'], function(){
					Route::post('store', 'TodoController@store')->name('projects.tasks.todos.store');
					Route::group(['prefix' => '{todo}'], function(){

						Route::put('update', 'TodoController@update')->name('projects.tasks.todos.update');
						Route::patch('mark', 'TodoController@mark')->name('projects.tasks.todo.mark');
						Route::delete('/', 'TodoController@destroy')->name('projects.tasks.todo.destroy');
					});

				});

				Route::group(['prefix' => 'membros'], function(){

					Route::get('/', 'TaskController@members')->name('projects.tasks.members');

					Route::post('{user}/attach', 'TaskController@attach')->name('projects.tasks.members.attach');
					Route::post('{user}/dettach', 'TaskController@dettach')->name('projects.tasks.members.dettach');

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



	
});
