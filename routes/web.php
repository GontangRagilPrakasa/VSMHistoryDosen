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

// Backoffice
Route::group(['prefix' => ''], function() {
	Route::group(['middleware' => 'guest'], function() {
		Route::get('/', ['as' => 'login', 'uses' => 'LoginController@index']);
		Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@login']);	
		Route::get('/forgot-password', 'LoginController@showLinkRequestForm');
		Route::post('/forgot-send', 'LoginController@sendResetLinkEmail');
		Route::get('/reset-password/{_token}', 'LoginController@showResetForm');
		Route::post('/update-password/{_token}', 'LoginController@updatePassword');	
	});

	Route::group(['middleware' => 'auth'], function() {	
		/* Logout */
		Route::get('/logout', 'LoginController@logout');
		// Start
		Route::get('/dashboard', 'DashboardController@index');
		Route::post('/search', 'DashboardController@search');
		// Route::get('/change-password', 'ProfileController@index');
		// Route::post('/change-password', 'ProfileController@update');

		/* Check role Super Admin */
		Route::group(['middleware' => 'check.role:2'], function () {
				Route::group(['prefix' => 'dosen'], function(){
				Route::get('/penelitian', 'Dosen\DosenController@penelitian');
				Route::post('/list-penelitian', 'Dosen\DosenController@listPenelitian');
				Route::get('/list-penelitian-tambah', 'Dosen\DosenController@listPenelitianTambah');
				Route::post('/list-penelitian-show', 'Dosen\DosenController@listPenelitianShow');
				Route::post('/list-penelitian-save', 'Dosen\DosenController@listPenelitianSave');
				Route::post('/list-penelitian-edit', 'Dosen\DosenController@listPenelitianEdit');
				Route::get('/mahasiswa', 'Dosen\DosenController@mahasiswa');
				Route::post('/list-mahasiswa', 'Dosen\DosenController@listMahasiswa');
				Route::post('/list-save-mahasiswa', 'Dosen\DosenController@listSaveMahasiswa');
			});
		});
		
		/* Check role Admin */
		Route::group(['middleware' => 'check.role:3'], function () {
			Route::group(['prefix' => 'mahasiswa'], function(){
				Route::get('/profile', 'Mahasiswa\MahasiswaController@profil');
				Route::post('/profile-save', 'Mahasiswa\MahasiswaController@profilSave');
				Route::get('/skripsi-form', 'Mahasiswa\MahasiswaController@skripsiForm');
				Route::post('/list-skripsi-form', 'Mahasiswa\MahasiswaController@listskripsiForm');

				Route::post('/pengajuan-skripsi', 'Mahasiswa\MahasiswaController@pengajuanSkripsi');
				Route::post('/pengajuan-batal-skripsi', 'Mahasiswa\MahasiswaController@pengajuanBatalskripsi');
			});
		});	
	});
});



