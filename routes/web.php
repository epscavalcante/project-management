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

	Route::get('/', 'ProjectController@index')->name('home');
	
	Route::group(['prefix' => 'novo'], function(){
		Route::get('/', 'ProjectController@create')->name('projects.create');
		Route::post('/', 'ProjectController@store')->name('projects.store');
	});

	Route::group(['prefix' => '{project}'], function(){
		
		Route::get('/', 'ProjectController@show')->name('projects.show');
		Route::delete('/', 'ProjectController@destroy')->name('projects.destroy');
		Route::group(['prefix' => 'editar'], function(){
			Route::get('/', 'ProjectController@edit')->name('projects.edit');
			Route::put('/', 'ProjectController@update')->name('projects.update');
		});

		Route::group(['prefix' => 'tarefas'], function(){
			
			#Funcionando
			Route::get('/', 'TaskController@index')->name('tasks.index');

			Route::group(['prefix' => 'nova'], function(){
				Route::get('/', 'TaskController@create')->name('tasks.create');
				Route::post('/', 'TaskController@store')->name('tasks.store');
			});

			Route::group(['prefix' => '{task}'], function(){
				#Funcionando
				Route::get('/', 'TaskController@show')->name('projects.tasks.show');
				Route::get('editar', 'TaskController@edit')->name('tasks.edit');
				
				Route::put('editar', 'TaskController@update')->name('tasks.update');
				Route::delete('excluir', 'TaskController@destroy')->name('projects.tasks.destroy');

			});
		});
		
	});

		


	Route::group(['prefix'=>'usuarios'], function(){

		Route::get('convidar','UserController@invatationForm')->name('users.invite');

	});

	Route::group(['prefix'=>'lixeira'], function(){

		Route::get('/','TrashController@index')->name('trash');
		
	});

	Route::group(['prefix'=>'perfil'], function(){

		Route::get('/','ProfileController@index')->name('profile');
		Route::get('senha','ProfileController@password')->name('profile.password');
		Route::get('notificacoes','ProfileController@notification')->name('profile.notification');
		
	});

	
});
