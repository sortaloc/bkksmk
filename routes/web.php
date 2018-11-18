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

Route::get('/', 'LPController@lp')->name('lp');
Route::get('/mitra', 'LPController@mitra');
Route::get('/tentang', 'LPController@tentang');
Route::get('/kontak', 'LPController@kontak');
Route::post('/kontak', 'LPController@kirimPesan');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::get('/register', 'Auth\RegisterController@index')->name('register');

Route::get('/registerCP', 'Auth\RegisterController@showRegisterCP')->name('registerCP');
Route::post('/registerCP', 'Auth\RegisterController@registerCP');

Route::get('/perusahaan/loker/add', 'Perusahaan\LokerController@index')->name('addLoker');
Route::post('/perusahaan/loker/add', 'Perusahaan\LokerController@addLoker');
Route::get('/perusahaan/loker/delete/{id}', 'Perusahaan\LokerController@deleteLoker');
Route::get('/perusahaan/loker/edit/{id}', 'Perusahaan\LokerController@editLoker');
Route::post('/perusahaan/loker/edit/{id}', 'Perusahaan\LokerController@updateLoker');
Route::get('/perusahaan/loker/daftar_pelamar/{id}', 'Perusahaan\LokerController@daftarPelamar');
Route::post('/perusahaan/loker/verif_pelamar/{id}', 'Perusahaan\LokerController@verifPelamar');
Route::post('/perusahaan/loker/tolak_pelamar/{id}', 'Perusahaan\LokerController@tolakPelamar');

Route::get('/admin/loker', 'Admin\LokerController@indexLoker');
Route::get('/admin/loker/add', 'Admin\LokerController@index');
Route::post('/admin/loker/add', 'Admin\LokerController@addLoker');
Route::get('/admin/loker/delete/{id}', 'Admin\LokerController@deleteLoker');
Route::get('/admin/loker/edit/{id}', 'Admin\LokerController@editLoker');
Route::post('/admin/loker/edit/{id}', 'Admin\LokerController@updateLoker');
Route::get('/admin/loker/daftar_pelamar/{id}', 'Admin\LokerController@daftarPelamar');
Route::post('/admin/loker/verif_pelamar/{id}', 'Admin\LokerController@verifPelamar');
Route::post('/admin/loker/tolak_pelamar/{id}', 'Admin\LokerController@tolakPelamar');

Route::get('/admin/perusahaan', 'Admin\PerusahaanController@index');
Route::get('/admin/perusahaan/edit/{id}', 'Admin\PerusahaanController@edit');
Route::post('/admin/perusahaan/edit/{id}', 'Admin\PerusahaanController@update');
Route::post('/admin/perusahaan/edit/password/{id}', 'Admin\PerusahaanController@updatePassword');
Route::get('/admin/perusahaan/add', 'Admin\PerusahaanController@add');
Route::post('/admin/perusahaan/add', 'Admin\PerusahaanController@store');
Route::get('/admin/perusahaan/{id}', 'Admin\PerusahaanController@destroy');

Route::get('/admin/cp', 'Admin\CPController@index');
Route::get('/admin/cp/edit/{id}', 'Admin\CPController@edit');
Route::post('/admin/cp/edit/{id}', 'Admin\CPController@update');
Route::post('/admin/cp/edit/password/{id}', 'Admin\CPController@updatePassword');
Route::get('/admin/cp/add', 'Admin\CPController@add');
Route::post('/admin/cp/add', 'Admin\CPController@store');
Route::get('/admin/cp/{id}', 'Admin\CPController@destroy');

Route::get('/admin/settings/password', 'SettingController@index');
Route::get('/perusahaan/settings/password', 'SettingController@index');
Route::get('/cp/settings/password', 'SettingController@index');

Route::post('/admin/settings/password', 'SettingController@gantiPassword');
Route::post('/perusahaan/settings/password', 'SettingController@gantiPassword');
Route::post('/cp/settings/password', 'SettingController@gantiPassword');

Route::get('/perusahaan/settings/datadiri', 'SettingController@dataDiriPerusahaan');
Route::get('/cp/settings/datadiri', 'SettingController@dataDiriCP');

Route::post('/perusahaan/settings/datadiri', 'SettingController@updateDataDiriPerusahaan');
Route::post('/perusahaan/settings/kontak', 'SettingController@updateDataKontakPerusahaan');
Route::post('/cp/settings/datadiri', 'SettingController@updateDataDiriCP');
Route::post('/cp/settings/kontak', 'SettingController@updateDataKontakCP');

Route::get('/cp/lamaran/{id}', 'CP\LamaranController@index');
Route::post('/cp/lamaran/{id}', 'CP\LamaranController@uploadLamaran');

Route::get('/cp/perusahaan/{id}', 'HomeController@profilPerusahaan');
Route::get('/cp/tutorial', 'HomeController@tutorialUpload');
Route::get('/admin/tutorial', 'HomeController@tutorialUpload');
Route::get('/admin/pengaturan', 'HomeController@pengaturanIndex');
Route::post('/admin/pengaturan', 'HomeController@ubahPengaturan');

Route::get('/admin/bukutamu', 'Admin\BukuTamuController@index');
Route::get('/admin/bukutamu/{id}', 'Admin\BukuTamuController@lihat');
Route::get('/admin/bukutamu/delete/{id}', 'Admin\BukuTamuController@hapus');

Route::get('/admin/kegiatan', 'Admin\KegiatanController@index');
Route::get('/admin/kegiatan/add', 'Admin\KegiatanController@add');
Route::post('/admin/kegiatan/add', 'Admin\KegiatanController@store');
Route::get('/admin/kegiatan/edit/{id}', 'Admin\KegiatanController@edit');
Route::post('/admin/kegiatan/edit/{id}', 'Admin\KegiatanController@update');
Route::get('/admin/kegiatan/{id}', 'Admin\KegiatanController@destroy');

Route::get('/cp/loker', 'HomeController@daftarCPLoker');
Route::get('/cp/lamaran', 'HomeController@daftarCPLamaran');

Route::get('/perusahaan/cp/{id}', 'Perusahaan\CPController@profile');
