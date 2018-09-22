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
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registerCP', 'Auth\RegisterController@showRegisterCP')->name('registerCP');
Route::post('/registerCP', 'Auth\RegisterController@registerCP');

Route::get('/perusahaan/loker/add', 'Perusahaan\LokerController@index')->name('addLoker');
Route::post('/perusahaan/loker/add', 'Perusahaan\LokerController@addLoker');
Route::get('/perusahaan/loker/delete/{id}', 'Perusahaan\LokerController@deleteLoker');
Route::get('/perusahaan/loker/edit/{id}', 'Perusahaan\LokerController@editLoker');
Route::post('/perusahaan/loker/edit/{id}', 'Perusahaan\LokerController@updateLoker');

Route::get('/admin/loker/add', 'Admin\LokerController@index');
Route::post('/admin/loker/add', 'Admin\LokerController@addLoker');
Route::get('/admin/loker/delete/{id}', 'Admin\LokerController@deleteLoker');
Route::get('/admin/loker/edit/{id}', 'Admin\LokerController@editLoker');
Route::post('/admin/loker/edit/{id}', 'Admin\LokerController@updateLoker');

Route::get('/admin/settings/password', 'SettingController@index');
Route::get('/perusahaan/settings/password', 'SettingController@index');
Route::get('/cp/settings/password', 'SettingController@index');

Route::post('/admin/settings/password', 'SettingController@gantiPassword');
Route::post('/perusahaan/settings/password', 'SettingController@gantiPassword');
Route::post('/cp/settings/password', 'SettingController@gantiPassword');

Route::get('/perusahaan/settings/datadiri', 'SettingController@dataDiriPerusahaan');
Route::get('/cp/settings/datadiri', 'SettingController@dataDiriCP');

Route::post('/perusahaan/settings/datadiri', 'SettingController@updateDataDiriPerusahaan');
Route::post('/cp/settings/datadiri', 'SettingController@updateDataDiriCP');
