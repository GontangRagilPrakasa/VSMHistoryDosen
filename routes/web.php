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

Route::get('/', ['as' => 'web', 'uses' => 'Page\PageController@index']);
Route::post('/list-kecamatan/{kabupaten_id}', ['as' => 'json-kecamatan', 'uses' => 'Page\PageController@kecamatan_by_kabupaten']);
Route::post('/list-desa/{kecamatan_id}', ['as' => 'json-desa', 'uses' => 'Page\PageController@desa_by_kecamatan']);
Route::post('/list-desa-all', ['as' => 'json-desa-all', 'uses' => 'Page\PageController@desa_by_name']);

// desa detail
Route::get('/indentitas-desa/{desa_id}', ['as' => 'desa', 'uses' => 'Page\DesaController@desa']);
Route::get('/geografi-desa/{desa_id}', ['as' => 'desa', 'uses' => 'Page\DesaController@geografi']);
Route::get('/demografi-desa/{desa_id}', ['as' => 'desa', 'uses' => 'Page\DesaController@demografi']);
Route::get('/idm-desa/{desa_id}', ['as' => 'desa', 'uses' => 'Page\DesaController@idm']);
Route::get('/kesehatan-desa/{desa_id}', ['as' => 'desa', 'uses' => 'Page\DesaController@kesehatan']);

// Backoffice
Route::group(['prefix' => ''], function() {
	Route::group(['middleware' => 'guest'], function() {
		Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@index']);
		Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@login']);	
		Route::get('/forgot-password', 'LoginController@showLinkRequestForm');
		Route::post('/forgot-send', 'LoginController@sendResetLinkEmail');
		Route::get('/reset-password/{_token}', 'LoginController@showResetForm');
		Route::post('/update-password/{_token}', 'LoginController@updatePassword');	
	});

	Route::group(['middleware' => 'auth'], function() {	
		/* get list route json */
		Route::group(['prefix' => 'json'], function() {
			Route::get('/kecamatan/{kecamatan_id}', 'MasterWilayahController@getSubDistrict')->name('jsonSubDistrinct');
			Route::get('/desa/{desa_id}', 'MasterWilayahController@getVillages')->name('jsonVillages');
		});
		/* Logout */
		Route::get('/logout', 'LoginController@logout');
		// Start
		Route::get('/dashboard', 'DashboardController@index');
		Route::get('/change-password', 'ProfileController@index');
		Route::post('/change-password', 'ProfileController@update');

		/* Check role Super Admin */
		Route::group(['middleware' => 'check.role:1'], function () {
			Route::group(['prefix' => 'admin'], function(){
				Route::get('/', 'AdminDesaController@index');
				Route::post('/list', 'AdminDesaController@list');
				Route::post('/save-data', 'AdminDesaController@store');
				Route::post('/show', 'AdminDesaController@show');
				Route::post('/delete', 'AdminDesaController@delete');
			});
		});
		
		/* Check role Admin */
		Route::group(['middleware' => 'check.role:5'], function () {
			Route::group(['prefix' => 'admin-desa'], function(){
				Route::get('/', 'AdminDesaController@index');
				/* Geografi */
				Route::group(['prefix' => 'geografi'], function(){
					Route::get('/', 'Desa\GeografiController@index');
					Route::post('/', 'Desa\GeografiController@save');
				});	

				Route::group(['prefix' => 'idm'], function(){
					Route::get('/', 'Desa\IndexDesaController@indexDesaMembangun');
					Route::post('/', 'Desa\IndexDesaController@saveDesaMembangun');
				});	

				Route::group(['prefix' => 'demografi'], function(){
					Route::get('/penduduk', 'Desa\DemografiController@indexPenduduk');
					Route::post('/penduduk', 'Desa\DemografiController@savePenduduk');
					Route::get('/kepala-keluarga', 'Desa\DemografiController@indexKepalaKeluarga');
					Route::post('/kepala-keluarga', 'Desa\DemografiController@saveKepalaKeluarga');
					Route::get('/usia', 'Desa\DemografiController@indexUsia');
					Route::post('/usia', 'Desa\DemografiController@saveUsia');
					Route::get('/pekerjaan', 'Desa\DemografiController@indexPekerjaan');
					Route::post('/pekerjaan', 'Desa\DemografiController@savePekerjaan');
				});	

				Route::group(['prefix' => 'identitas'], function(){
					Route::get('/organisasi-desa', 'Desa\MasterDesaController@indexOrganisasiDesa');
					Route::post('/organisasi-desa', 'Desa\MasterDesaController@saveOrganisasiDesa');
					Route::get('/desa-wilayah', 'Desa\MasterDesaController@indexDesaWilayah');
					Route::post('/desa-wilayah', 'Desa\MasterDesaController@saveDesaWilayah');
					Route::get('/desa-kades', 'Desa\MasterDesaController@indexDesaKades');
					Route::post('/desa-kades', 'Desa\MasterDesaController@saveDesaKades');
				});	

				Route::group(['prefix' => 'kesehatan'], function(){
					Route::get('/apotek', 'Desa\KesehatanController@indexKesehatanApotek');
					Route::post('/apotek', 'Desa\KesehatanController@saveKesehatanApotek');
					Route::get('/bersalin', 'Desa\KesehatanController@indexKesehatanBersalin');
					Route::post('/bersalin', 'Desa\KesehatanController@saveKesehatanBersalin');
					Route::get('/bidan', 'Desa\KesehatanController@indexKesehatanBidan');
					Route::post('/bidan', 'Desa\KesehatanController@saveKesehatanBidan');
					Route::get('/dokter-praktek', 'Desa\KesehatanController@indexKesehatanDrPraktek');
					Route::post('/dokter-praktek', 'Desa\KesehatanController@saveKesehatanDrPraktek');
					Route::get('/puskesmas-inap', 'Desa\KesehatanController@indexKesehatanPuskesmasInap');
					Route::post('/puskesmas-inap', 'Desa\KesehatanController@saveKesehatanPuskesmasInap');
					Route::get('/puskesmas-pembantu', 'Desa\KesehatanController@indexKesehatanPuskesmasPembantu');
					Route::post('/puskesmas-pembantu', 'Desa\KesehatanController@saveKesehatanPuskesmasPembantu');
					Route::get('/puskesmas-tanpa-inap', 'Desa\KesehatanController@indexKesehatanPuskesmasTanpaInap');
					Route::post('/puskesmas-tanpa-inap', 'Desa\KesehatanController@saveKesehatanPuskesmasTanpaInap');
					Route::get('/rumah-sakit', 'Desa\KesehatanController@indexKesehatanRs');
					Route::post('/rumah-sakit', 'Desa\KesehatanController@saveKesehatanRs');
					Route::get('/rumah-sakit-bersalin', 'Desa\KesehatanController@indexKesehatanRsBersalin');
					Route::post('/rumah-sakit-bersalin', 'Desa\KesehatanController@saveKesehatanRsBersalin');
					Route::get('/sarana', 'Desa\KesehatanController@indexKesehatanSarana');
					Route::post('/sarana', 'Desa\KesehatanController@saveKesehatanSarana');
					Route::get('/tenaga', 'Desa\KesehatanController@indexKesehatanTenaga');
					Route::post('/tenaga', 'Desa\KesehatanController@saveKesehatanTenaga');
					Route::get('/poliklinik', 'Desa\KesehatanController@indexKesehatanPoliklinik');
					Route::post('/poliklinik', 'Desa\KesehatanController@saveKesehatanPoliklinik');

					Route::get('/poskes', 'Desa\KesehatanNextController@indexAksesPoskes');
					Route::post('/poskes', 'Desa\KesehatanNextController@saveAksesPoskes');
					Route::get('/peserta-bpjs', 'Desa\KesehatanNextController@indexPesertaBpjs');
					Route::post('/peserta-bpjs', 'Desa\KesehatanNextController@savePesertaBpjs');
					Route::get('/gizi-buruk', 'Desa\KesehatanNextController@indexGiziBuruk');
					Route::post('/gizi-buruk', 'Desa\KesehatanNextController@saveGiziBuruk');
					Route::get('/sasaran-hpk', 'Desa\KesehatanNextController@indexSasaranHpk');
					Route::post('/sasaran-hpk', 'Desa\KesehatanNextController@saveSasaranHpk');
					Route::get('/tikar-pertumbuhan', 'Desa\KesehatanNextController@indexTikarPertumbuhan');
					Route::post('/tikar-pertumbuhan', 'Desa\KesehatanNextController@saveTikarPertumbuhan');
					Route::get('/hpk-bumil', 'Desa\KesehatanNextController@indexHpkBumil');
					Route::post('/hpk-bumil', 'Desa\KesehatanNextController@saveHpkBumil');
					Route::get('/hpk-baduta', 'Desa\KesehatanNextController@indexHpkBaduta');
					Route::post('/hpk-baduta', 'Desa\KesehatanNextController@saveHpkBaduta');
					Route::get('/hpk-balita', 'Desa\KesehatanNextController@indexHpkBalita');
					Route::post('/hpk-balita', 'Desa\KesehatanNextController@saveHpkBalita');
				});	


			});	
		});	
	});
});



