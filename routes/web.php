<?php
use App\Exports\InscriptionExport;
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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('user-list-excel', 'UserController@exportExcel')->name('users.excel');
///participants','ParticipantController@index



Route::group(['middleware' => ['auth']], function() {

    Route::resource('companies','CompanyController');
    Route::resource('unities','UnityController');
    Route::resource('roles','RoleController');
    Route::resource('products','ProductController');
    Route::resource('courses','CourseController');
    Route::resource('type_courses','TipoCourseController');
    Route::resource('courses','CourseController');
    Route::resource('locations','LocationController');

    /**
     *
     * rutas de inscription
     *
    **/

    Route::resource('inscriptions','InscriptionController');
    Route::get('inscriptions/register/{inscription}', 'InscriptionController@register')->name('inscriptions.register');
    Route::post('inscriptions/register/{inscription}', 'InscriptionController@register_save')->name('inscriptions.register_save');
    Route::get('inscriptions/register-grade/{inscription}', 'InscriptionController@grade')->name('inscriptions.grade');
    Route::get('inscriptions/export-list-excel/{inscription}', 'InscriptionController@exportExcel')->name('inscriptions.export');
    Route::post('inscriptions/import-list-excel/{inscription}', 'InscriptionController@importExcel')->name('inscriptions.import');

    /**
     *
     * rutas de inscription
     *
    **/

    
    Route::get('participants/export-excel','ParticipantController@export')->name('participants.export');
    Route::post('participants/import-excel','ParticipantController@import')->name('participants.import');
    Route::resource('users','UserController');
    Route::resource('participants','ParticipantController');
    Route::resource('facilitadors','FacilitadorController');

});
