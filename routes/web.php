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
		Route::get('editar', 'ProjectController@edit')->name('projects.edit');
		Route::put('editar', 'ProjectController@update')->name('projects.update');
		Route::delete('arquivar', 'ProjectController@destroy')->name('projects.destroy');
		Route::delete('excluir', 'ProjectController@forceDestroy')->name('projects.destroy.force');

		Route::group(['prefix' => 'tarefas'], function(){
			Route::get('/', 'TaskController@index')->name('projects.tasks');
			Route::post('criar', 'TaskController@store')->name('projects.tasks.store');

			Route::group(['prefix' => '{task}'], function(){
				Route::get('/', 'TaskController@show')->name('projects.tasks.show');
				Route::put('restaurar', 'TaskController@restore')->name('projects.tasks.restore');
				Route::delete('arquivar', 'TaskController@destroy')->name('projects.tasks.destroy');
				Route::delete('excluir', 'TaskController@forceDestroy')->name('projects.tasks.destroy.force');
			});
			
		});

		Route::group(['prefix' => 'membros'], function(){
			
			Route::get('/', 'MemberController@index')->name('projects.members');
			Route::put('/', 'MemberController@sync')->name('projects.members.sync');

		});
		
	});



});

Route::group(['prefix'=>'usuarios'], function(){

	Route::get('convidar','UserController@invatationForm')->name('users.invite');

});

Route::group(['prefix'=>'lixeira'], function(){

	Route::get('/','TrashController@index')->name('trash');
	
});