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
Route::get('/berita', 'BeritaController@index');
Route::get('/kontak', 'LPController@kontak');
Route::post('/kontak', 'LPController@kirimPesan');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/login', 'Auth\LoginController@index')->name('login');
Route::get('/register', 'Auth\RegisterController@index')->name('register');

Route::get('/registerCP', 'Auth\RegisterController@showRegisterCP')->name('registerCP');
Route::post('/registerCP', 'Auth\RegisterController@registerCP');

Route::get('/berita/{slug}', 'LPController@detailBerita');

Route::get('/perusahaan/loker', 'Perusahaan\LokerController@index');
Route::get('/perusahaan/loker/add', 'Perusahaan\LokerController@add')->name('addLoker');
Route::post('/perusahaan/loker/add', 'Perusahaan\LokerController@store');
Route::get('/perusahaan/loker/edit/{id}', 'Perusahaan\LokerController@edit');
Route::post('/perusahaan/loker/edit/{id}', 'Perusahaan\LokerController@update');
Route::get('/perusahaan/loker/delete/{id}', 'Perusahaan\LokerController@destroy');

Route::get('/perusahaan/loker/daftar_pelamar/{id}', 'Perusahaan\LokerController@daftarPelamar');
Route::post('/perusahaan/loker/verif_pelamar/{id}', 'Perusahaan\LokerController@verifPelamar');
Route::post('/perusahaan/loker/tolak_pelamar/{id}', 'Perusahaan\LokerController@tolakPelamar');

Route::get('/perusahaan/berita', 'Perusahaan\BeritaController@index');

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
Route::post('/admin/perusahaan/edit/verifikasi/{id}', 'Admin\PerusahaanController@verifikasiAkun');
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

Route::get('/admin/alumni', 'Admin\AlumniController@index');
Route::get('/admin/alumni/edit/{id}', 'Admin\AlumniController@edit');
Route::post('/admin/alumni/edit/{id}', 'Admin\AlumniController@update');
Route::get('/admin/alumni/add', 'Admin\AlumniController@create');
Route::post('/admin/alumni/add', 'Admin\AlumniController@store');
Route::get('/admin/alumni/{id}', 'Admin\AlumniController@destroy');

Route::get('/admin/settings/password', 'SettingController@index');
Route::get('/perusahaan/settings/password', 'SettingController@index');
Route::get('/cp/settings/password', 'SettingController@index');

Route::post('/admin/settings/password', 'SettingController@gantiPassword');
Route::post('/perusahaan/settings/password', 'SettingController@gantiPassword');
Route::post('/cp/settings/password', 'SettingController@gantiPassword');

Route::get('/perusahaan/settings/datadiri', 'Perusahaan\SettingsController@dataDiriPerusahaan');
Route::get('/cp/settings/datadiri', 'CP\SettingsController@dataDiriCP');

Route::post('/perusahaan/settings/datadiri', 'Perusahaan\SettingsController@updateDataDiriPerusahaan');
Route::post('/cp/settings/datadiri', 'CP\SettingsController@updateDataDiriCP');

Route::get('/cp/lamaran/{id}', 'CP\LamaranController@index');
Route::post('/cp/lamaran/{id}', 'CP\LamaranController@uploadLamaran');

Route::get('/cp/perusahaan/{id}', 'CP\PerusahaanController@profilPerusahaan');
Route::get('/cp/tutorial', 'HomeController@tutorialUpload');
Route::get('/admin/tutorial', 'HomeController@tutorialUpload');
Route::get('/admin/pengaturan', 'Admin\PengaturanController@pengaturanIndex');
Route::post('/admin/pengaturan', 'Admin\PengaturanController@ubahPengaturan');

Route::get('/admin/bukutamu', 'Admin\BukuTamuController@index');
Route::get('/admin/bukutamu/{id}', 'Admin\BukuTamuController@lihat');
Route::get('/admin/bukutamu/delete/{id}', 'Admin\BukuTamuController@hapus');

Route::get('/admin/kegiatan', 'Admin\KegiatanController@index');
Route::get('/admin/kegiatan/add', 'Admin\KegiatanController@add');
Route::post('/admin/kegiatan/add', 'Admin\KegiatanController@store');
Route::get('/admin/kegiatan/edit/{id}', 'Admin\KegiatanController@edit');
Route::post('/admin/kegiatan/edit/{id}', 'Admin\KegiatanController@update');
Route::get('/admin/kegiatan/{id}', 'Admin\KegiatanController@destroy');

Route::get('/admin/berita', 'Admin\BeritaController@index');
Route::get('/admin/berita/add', 'Admin\BeritaController@add');
Route::post('/admin/berita/add', 'Admin\BeritaController@store');
Route::get('/admin/berita/edit/{slug}', 'Admin\BeritaController@edit');
Route::post('/admin/berita/edit/{id}', 'Admin\BeritaController@update');
Route::get('/admin/berita/{id}', 'Admin\BeritaController@destroy');

Route::get('/cp/loker', 'CP\LokerController@daftarCPLoker');
Route::get('/cp/lamaran', 'CP\LokerController@daftarCPLamaran');
Route::get('/cp/berita', 'CP\BeritaController@index');

Route::get('/perusahaan/cp/{id}', 'Perusahaan\CPController@profile');

Route::post('/uploadCMSFile', 'HomeController@uploadCMSFile');

// Drive
Route::get('/admin/drive', 'Admin\DriveController@getDrive'); // retreive folders
Route::get('/admin/drive/upload', 'Admin\DriveController@uploadFile'); // File upload form
Route::post('/admin/drive/upload', 'Admin\DriveController@uploadFile'); // Upload file to Drive from Form
Route::get('/admin/drive/create', 'Admin\DriveController@create'); // Upload file to Drive from Storage
Route::get('/admin/drive/delete/{id}', 'Admin\DriveController@deleteFile'); // Delete file or folder
Route::get('/admin/drive/test', 'Admin\DriveController@test');

Route::get('/google', 'HomeController@redirectToGoogleProvider');
Route::get('/google/done', 'HomeController@closePopup');
Route::get('/google/callback', 'HomeController@handleProviderGoogleCallback');
