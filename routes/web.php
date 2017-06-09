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

Route::get('/', 'HomeController@index');

Route::group(['prefix'=>'admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {

	Route::get('/',['as' => 'main', 'uses' => 'HomeController@index']);

	/*ROUTES TO TEACHER*/
	Route::group(['prefix'=>'professores',             'as' => 'teacher.'], function() {
		Route::get('listar',                      ['as' => 'list',      'uses' => 'TeacherController@roll'      ]);
		Route::get('cadastrar',                   ['as' => 'create',    'uses' => 'TeacherController@create'    ]);
		Route::post('cadastrar',                  ['as' => 'store',     'uses' => 'TeacherController@store'     ]);
		Route::get('editar/{slug?}',              ['as' => 'edit',      'uses' => 'TeacherController@edit'      ]);
		Route::put('editar/{slug?}',              ['as' => 'update',    'uses' => 'TeacherController@update'    ]);
		Route::get('excluir/{slug?}',             ['as' => 'delete',    'uses' => 'TeacherController@delete'    ]);
		Route::get('situation/{slug?}/{action?}', ['as' => 'situation', 'uses' => 'TeacherController@situation' ]);
	});
	/*---------------*/

	/*ROUTES TO STUDENT*/
	Route::group(['prefix'=>'alunos',             'as' => 'student.'], function() {
		Route::get('listar',                      ['as' => 'list',      'uses' => 'StudentController@roll'      ]);
		Route::get('cadastrar',                   ['as' => 'create',    'uses' => 'StudentController@create'    ]);
		Route::post('cadastrar',                  ['as' => 'store',     'uses' => 'StudentController@store'     ]);
		Route::get('editar/{slug?}',              ['as' => 'edit',      'uses' => 'StudentController@edit'      ]);
		Route::put('editar/{slug?}',              ['as' => 'update',    'uses' => 'StudentController@update'    ]);
		Route::get('excluir/{slug?}',             ['as' => 'delete',    'uses' => 'StudentController@delete'    ]);
		Route::get('situation/{slug?}/{action?}', ['as' => 'situation', 'uses' => 'StudentController@situation' ]);
	});
	/*---------------*/

	/*ROUTES TO EMPLOYEE*/
	Route::group(['prefix'=>'funcionarios', 'as' => 'employee.'], function() {
		Route::get('listar',                      ['as' => 'list',      'uses' => 'EmployeeController@roll'      ]);
		Route::get('cadastrar',                   ['as' => 'create',    'uses' => 'EmployeeController@create'    ]);
		Route::post('cadastrar',                  ['as' => 'store',     'uses' => 'EmployeeController@store'     ]);
		Route::get('editar/{slug?}',              ['as' => 'edit',      'uses' => 'EmployeeController@edit'      ]);
		Route::put('editar/{slug?}',              ['as' => 'update',    'uses' => 'EmployeeController@update'    ]);
		Route::get('excluir/{slug?}',             ['as' => 'delete',    'uses' => 'EmployeeController@delete'    ]);
		Route::get('situation/{slug?}/{action?}', ['as' => 'situation', 'uses' => 'EmployeeController@situation' ]);
	});
	/*---------------*/

	/*ROUTES TO PATROMONIES*/
	Route::group(['prefix'=>'patrimonios', 'as' => 'patrimony.'], function() {
		Route::get('listar',                      ['as' => 'list',      'uses' => 'PatrimonyController@roll'      ]);
		Route::get('cadastrar',                   ['as' => 'create',    'uses' => 'PatrimonyController@create'    ]);
		Route::post('cadastrar',                  ['as' => 'store',     'uses' => 'PatrimonyController@store'     ]);
		Route::get('editar/{slug?}',              ['as' => 'edit',      'uses' => 'PatrimonyController@edit'      ]);
		Route::put('editar/{slug?}',              ['as' => 'update',    'uses' => 'PatrimonyController@update'    ]);
		Route::get('excluir/{slug?}',             ['as' => 'delete',    'uses' => 'PatrimonyController@delete'    ]);
		Route::get('situation/{slug?}/{action?}', ['as' => 'situation', 'uses' => 'PatrimonyController@situation' ]);
	});
	/*---------------*/

	/*ROUTES TO EVENTS*/
	Route::group(['prefix'=>'eventos', 'as' => 'event.'], function() {
		Route::get('listar',                      ['as' => 'list',      'uses' => 'EventController@roll'      ]);
		Route::get('cadastrar',                   ['as' => 'create',    'uses' => 'EventController@create'    ]);
		Route::post('cadastrar',                  ['as' => 'store',     'uses' => 'EventController@store'     ]);
		Route::get('editar/{slug?}',              ['as' => 'edit',      'uses' => 'EventController@edit'      ]);
		Route::put('editar/{slug?}',              ['as' => 'update',    'uses' => 'EventController@update'    ]);
		Route::get('excluir/{slug?}',             ['as' => 'delete',    'uses' => 'EventController@delete'    ]);
		Route::get('situation/{slug?}/{action?}', ['as' => 'situation', 'uses' => 'EventController@situation' ]);
	});
	/*---------------*/

	/*ROUTES TO SUBJECTS*/
	Route::group(['prefix'=>'materias', 'as' => 'subject.'], function() {
		Route::get('listar',                      ['as' => 'list',      'uses' => 'SubjectController@roll'      ]);
		Route::get('cadastrar',                   ['as' => 'create',    'uses' => 'SubjectController@create'    ]);
		Route::post('cadastrar',                  ['as' => 'store',     'uses' => 'SubjectController@store'     ]);
		Route::get('editar/{slug?}',              ['as' => 'edit',      'uses' => 'SubjectController@edit'      ]);
		Route::put('editar/{slug?}',              ['as' => 'update',    'uses' => 'SubjectController@update'    ]);
		Route::get('excluir/{slug?}',             ['as' => 'delete',    'uses' => 'SubjectController@delete'    ]);
		Route::get('situation/{slug?}/{action?}', ['as' => 'situation', 'uses' => 'SubjectController@situation' ]);

		Route::group(['prefix'=>'turmas', 'as' => 'time.'], function() {
			Route::get('listar/{slug?}',              ['as' => 'list',       'uses' => 'ClassController@roll'     ]);
			Route::get('cadastrar',                   ['as' => 'create',    'uses' => 'ClassController@create'    ]);
			Route::post('cadastrar',                  ['as' => 'store',     'uses' => 'ClassController@store'     ]);
			Route::get('editar/{slug?}',              ['as' => 'edit',      'uses' => 'ClassController@edit'      ]);
			Route::put('editar/{slug?}',              ['as' => 'update',    'uses' => 'ClassController@update'    ]);
			Route::get('excluir/{slug?}',             ['as' => 'delete',    'uses' => 'ClassController@delete'    ]);
			Route::get('situation/{slug?}/{action?}/{subject?}', ['as' => 'situation', 'uses' => 'ClassController@situation' ]);
			Route::get('alunos/{id?}', ['as' => 'student', 'uses' => 'ClassController@student' ]);
			Route::post('alunos/cadastrar/{id?}', ['as' => 'student.store', 'uses' => 'ClassController@studentStore' ]);
			Route::get('alunos/deletar/{user?}/{id?}', ['as' => 'student.delete', 'uses' => 'ClassController@studentDelete' ]);
		});
	});
	/*---------------*/


	/*ROUTES TO TESTS*/
	Route::group(['prefix'=>'provas', 'as' => 'test.'], function() {
		Route::get('listar/{id?}',                      ['as' => 'list',      'uses' => 'TestController@roll'      ]);
		Route::get('cadastrar',                   ['as' => 'create',    'uses' => 'TestController@create'    ]);
		Route::post('cadastrar',                  ['as' => 'store',     'uses' => 'TestController@store'     ]);
		Route::get('editar/{slug?}',              ['as' => 'edit',      'uses' => 'TestController@edit'      ]);
		Route::put('editar/{slug?}',              ['as' => 'update',    'uses' => 'TestController@update'    ]);
		Route::get('excluir/{slug?}',             ['as' => 'delete',    'uses' => 'TestController@delete'    ]);
		Route::get('situation/{slug?}/{action?}', ['as' => 'situation', 'uses' => 'TestController@situation' ]);
		Route::get('notas/{subject?}/{test?}',    ['as' => 'notation', 'uses' => 'TestController@notation'  ]);
		Route::post('notas/{student?}/{test?}/{subject?}',    ['as' => 'notation.store', 'uses' => 'TestController@notationStore' ]);
		Route::post('notas/editar/{student?}/{test?}/{subject?}',    ['as' => 'notation.update', 'uses' => 'TestController@notationUpdate' ]);
	});

	/*ROUTES TO RESERVES*/
	Route::group(['prefix'=>'reservas', 'as' => 'reserve.'], function() {
		Route::get('listar/{type?}/{aux?}',       ['as' => 'list',      'uses' => 'ReserveController@roll'      ]);
		Route::get('cadastrar/{type?}/{aux?}',    ['as' => 'create',    'uses' => 'ReserveController@create'    ]);
		Route::post('cadastrar',                  ['as' => 'store',     'uses' => 'ReserveController@store'     ]);
		Route::get('editar/{slug?}',              ['as' => 'edit',      'uses' => 'ReserveController@edit'      ]);
		Route::put('editar/{slug?}',              ['as' => 'update',    'uses' => 'ReserveController@update'    ]);
		Route::get('excluir/{slug?}',             ['as' => 'delete',    'uses' => 'ReserveController@delete'    ]);
		Route::get('situation/{slug?}/{action?}', ['as' => 'situation', 'uses' => 'ReserveController@situation' ]);
	});
	/*---------------*/

	/*ROUTES TO RESERVES*/
	Route::group(['prefix'=>'usuarios', 'as' => 'user.'], function() {
		Route::get('listar/',        ['as' => 'list',   'uses' => 'Auth\RegisterController@roll'   ]);
		Route::get('cadastrar/',   ['as' => 'create',   'uses' => 'Auth\RegisterController@create2'   ]);
		Route::post('cadastrar/',   ['as' => 'store', 'uses' => 'Auth\RegisterController@store' ]);
		Route::get('editar/{id?}',   ['as' => 'edit',   'uses' => 'Auth\RegisterController@edit'   ]);
		Route::put('editar/{id?}',   ['as' => 'update', 'uses' => 'Auth\RegisterController@update' ]);
		Route::get('excluir/{id?}',  ['as' => 'delete', 'uses' => 'Auth\RegisterController@delete' ]);
	});
	/*---------------*/

});
