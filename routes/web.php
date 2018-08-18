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

	Route::group(['prefix'=>'perfil'], function(){

		Route::get('/','ProfileController@index')->name('profile');
		Route::get('senha','ProfileController@password')->name('profile.password');
		Route::get('notificacoes','ProfileController@notification')->name('profile.notification');
		
	});



	Route::get('/', 'HomeController@index')->name('home');
	Route::get('home', 'HomeController@index')->name('home');
	Route::get('novo', 'ProjectController@create')->name('projects.create');
	Route::post('novo', 'ProjectController@store')->name('projects.store');

	Route::group(['prefix' => '{project}'], function(){
		
		#Funcionando
		Route::get('/', 'ProjectController@show')->name('projects.show');
		Route::delete('/', 'ProjectController@destroy')->name('projects.destroy');
		
		#Funcionando
		Route::group(['prefix' => 'editar', 'middleware' => 'auth'], function(){
			Route::get('/', 'ProjectController@edit')->name('projects.edit');
			Route::put('/', 'ProjectController@update')->name('projects.update');
		});

		Route::group(['prefix' => 'membros'], function(){
			Route::get('/', 'ProjectController@members')->name('projects.members');
			
			Route::delete('{user}', 'MemberController@destroy')->name('projects.members.destroy')->middleware('CheckManageProject');
			Route::post('convidar', 'MemberController@invite')->name('projects.members.invite')->middleware('CheckManageProject');
		});

		Route::group(['prefix' => 'tarefas'], function(){
			#Funcionando
			Route::get('/', 'ProjectController@tasks')->name('projects.tasks');
			Route::post('/', 'TaskController@store')->name('projects.tasks.store');

			Route::group(['prefix' => '{task}', 'middleware' => 'CheckUserAccessForTask'], function(){
				#Funcionando
				Route::get('/', 'TaskController@show')->name('projects.tasks.show');
				Route::put('editar', 'TaskController@update')->name('projects.tasks.update')->middleware('CheckManageTask');
				Route::delete('excluir', 'TaskController@destroy')->name('projects.tasks.destroy')->middleware('CheckManageTask');

				#Não ta pronto
				Route::group(['prefix' => 'todos'], function(){
					Route::post('/', 'TodoController@store')->name('projects.tasks.todos.store');
					Route::group(['prefix' => '{todo}'], function(){
						Route::put('/', 'TodoController@update')->name('projects.tasks.todos.update');
						Route::patch('mark', 'TodoController@mark')->name('projects.tasks.todo.mark');
						Route::delete('/', 'TodoController@destroy')->name('projects.tasks.todo.destroy');
					});
				});			

				#Funcionando
				Route::group(['prefix' => 'membros'], function(){

					Route::get('/', 'TaskController@members')->name('projects.tasks.members');

					Route::post('{user}/attach', 'TaskController@attach')->name('projects.tasks.members.attach')->middleware('CheckManageTask');
					Route::post('{user}/dettach', 'TaskController@dettach')->name('projects.tasks.members.dettach')->middleware('CheckManageTask');

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
