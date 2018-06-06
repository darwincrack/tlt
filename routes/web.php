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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'PersonalController@index');
Route::get('/home', 'HomeController@index');


Route::get('personal', 'PersonalController@index');
Route::get('personal/data', 'PersonalController@anyData');
Route::get('personal/add', 'PersonalController@add');
Route::post('personal/add', 'PersonalController@store');
Route::get('personal/editar/{id}', 'PersonalController@editar')->where('id','[0-9]+');
Route::post('personal/editar/', 'PersonalController@store_editar');
Route::get('personal/subgrupo/get/{id_grupo}', 'PersonalController@select_subgrupo');

Route::get('personal/get/{grupo?}/{subgrupo?}', 'PersonalController@select_personal')->where(['grupo'=>'[0-9]+', 'subgrupo' => '[0-9]+']);





Route::get('horario/{id}', 'HorarioController@index')->where('id','[0-9]+');
Route::post('horario/add', 'HorarioController@store');
Route::post('horario/editar/', 'HorarioController@store_editar');



Route::get('ubicacion', 'UbicacionController@index');
Route::get('ubicacion/data', 'UbicacionController@anyData');
Route::get('ubicacion/add', 'UbicacionController@add');
Route::post('ubicacion/add', 'UbicacionController@store');
Route::get('ubicacion/editar/{id}', 'UbicacionController@editar')->where('id','[0-9]+');
Route::post('ubicacion/editar/', 'UbicacionController@store_editar');



Route::get('articulos', 'ArticulosController@index');
Route::get('articulos/data', 'ArticulosController@anyData');
Route::get('articulos/add', 'ArticulosController@add');
Route::post('articulos/add', 'ArticulosController@store');
Route::get('articulos/editar/{id}', 'ArticulosController@editar')->where('id','[0-9]+');
Route::post('articulos/editar/', 'ArticulosController@store_editar');





Route::get('cargo', 'CargoController@index');
Route::get('cargo/data', 'CargoController@anyData');
Route::get('cargo/add', 'CargoController@add');
Route::post('cargo/add', 'CargoController@store');
Route::get('cargo/editar/{id}', 'CargoController@editar')->where('id','[0-9]+');
Route::post('cargo/editar/', 'CargoController@store_editar');

Route::get('departamento', 'DepartamentoController@index');
Route::get('departamento/data', 'DepartamentoController@anyData');
Route::get('departamento/add', 'DepartamentoController@add');
Route::post('departamento/add', 'DepartamentoController@store');
Route::get('departamento/editar/{id}', 'DepartamentoController@editar')->where('id','[0-9]+');
Route::post('departamento/editar/', 'DepartamentoController@store_editar');






Route::get('subgrupo', 'SubGrupoController@index');
Route::get('subgrupo/data', 'SubGrupoController@anyData');
Route::get('subgrupo/add', 'SubGrupoController@add');
Route::post('subgrupo/add', 'SubGrupoController@store');
Route::get('subgrupo/editar/{id}', 'SubGrupoController@editar')->where('id','[0-9]+');
Route::post('subgrupo/editar/', 'SubGrupoController@store_editar');

Route::get('subgrupo/get/{id_grupo}', 'PersonalController@select_subgrupo');
Route::get('subgrupo/get', 'PersonalController@select_subgrupo');




Route::get('configuracion', 'ConfiguracionController@index');
Route::post('configuracion', 'ConfiguracionController@store_editar');


Route::get('configuracion/diasferiados', 'ConfiguracionController@diasferiados');
Route::get('configuracion/diasferiados/data', 'ConfiguracionController@anyData');
Route::get('configuracion/diasferiados/add', 'ConfiguracionController@add_diasferiados');
Route::post('configuracion/diasferiados/add', 'ConfiguracionController@store_diasferiados');
Route::get('configuracion/diasferiados/editar/{id}', 'ConfiguracionController@editar_diasferiados')->where('id','[0-9]+');
Route::post('configuracion/diasferiados/editar/', 'ConfiguracionController@store_editar_diasferiados');

Route::get('configuracion/diasferiados/delete/{id}', 'ConfiguracionController@delete_diasferiados')->where('id','[0-9]+');


Route::get('reportes', 'ReportesController@index');
Route::get('reportes/data', 'ReportesController@anyData');
Route::post('reportes/generalavanzada', 'ReportesController@generalavanzada');



Route::get('tiposjustificacion', 'TiposJustificacionController@index');
Route::get('tiposjustificacion/data', 'TiposJustificacionController@anyData');
Route::get('tiposjustificacion/add', 'TiposJustificacionController@add');
Route::post('tiposjustificacion/add', 'TiposJustificacionController@store');
Route::get('tiposjustificacion/editar/{id}', 'TiposJustificacionController@editar')->where('id','[0-9]+');
Route::post('tiposjustificacion/editar/', 'TiposJustificacionController@store_editar');
Route::get('tiposjustificacion/delete/{id}', 'TiposJustificacionController@delete')->where('id','[0-9]+');




Route::post('justificativos/add', 'JustificativoController@store');
Route::get('justificativos/add/{id_usuario}/{name}/{tipo_falta}/{hora_marcaje}/{fecha}', 'JustificativoController@add')->where(['id_usuario'=>'[0-9]+', 'tipo_falta' => '[0-9]+']);
Route::get('reportes/justificativos', 'JustificativoController@index');
Route::get('reportes/justificativos/data', 'JustificativoController@anyData');
Route::get('justificativos/delete/{id}', 'JustificativoController@delete')->where('id','[0-9]+');


Route::get('logsistema', 'LogsistemaController@index');
Route::get('logsistema/data', 'LogsistemaController@anyData');