<?php

use Illuminate\Support\Facades\Route;

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
Route::prefix('/home')->group(function(){

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/editor', function(){
        $active = "editor";
        return view('editor', compact('active'));
    })->name('home.editor');

    //  route resource
	Route::resource('/periode', 'Admin\PeriodeController');
	Route::resource('/tingkat', 'Admin\TingkatController');
	Route::resource('/kelas', 'Admin\KelasController');
    Route::resource('/matpel', 'Admin\MatpelController');
    Route::resource('/bank-soal', 'Admin\BankSoalController');
    Route::resource('/data-ujian', 'Admin\UjianController');
    Route::resource('/jawaban', 'Admin\JawabanController');
    Route::resource('/paket-ujian', 'Admin\PaketController');
    Route::resource('/pilih-soal', 'Admin\SoalController');
    Route::resource('/berita', 'Admin\BeritaController');
    Route::resource('/pengumuman', 'Admin\PengumumanController');
    Route::resource('/setting', 'Admin\SettingAkunController');

    Route::post('/import/soal/{kondisi}/{id}', 'Admin\BankSoalController@importSoal')->name('import.soal');

    Route::post('/import/media', 'Admin\BankSoalController@importMedia')->name('import.media');

    Route::post('/import/jawaban/all', 'Admin\BankSoalController@importJawabanAll')->name('import.jawaban.all');

    Route::post('/import/jawaban/text/{id}', 'Admin\JawabanController@importJawabanText')->name('import.jawaban.text');

    Route::get('/name/media', 'Admin\BankSoalController@NameMedia')->name('name.media');

    // route manual 
    Route::get('/soal', 'HomeController@soaltingkat');
    Route::get('/hama', 'HomeController@getHama');
    Route::get('/hama/{id}', 'HomeController@showHama');
    Route::get('/soal/matpel/{id}', 'HomeController@soalmatpel');
    Route::get('/soal/data/soal/{id}', 'HomeController@soaldata'); 
    Route::get('/soal/form/{kondisi}/{id}', 'HomeController@formsoal');
    Route::get('/soal/jawaban/data/{id}', 'HomeController@jawabandata');
    Route::get('/soal/data/detail/{kondisi}/{id}', 'HomeController@getDetailSoalJawaban');
    Route::get('/ujian', 'HomeController@getUjian');
    Route::get('/ujian/paket/{id}', 'HomeController@getPaket');
    Route::get('/pilih/soal/paket/{id}', 'HomeController@getSoalPaket')->name('pilih.soal.paket');

    Route::get('/berita/comfir/delete/{id}', 'Admin\BeritaController@getDelete')->name('berita.delete');
    Route::get('/pengumuman/comfir/delete/{id}', 'Admin\PengumumanController@getDelete')->name('pengumuman.delete');


    Route::put('/setting/username/{id}', 'Admin\SettingAkunController@upUsername')->name('setting.username');
    Route::put('/setting/password/{id}', 'Admin\SettingAkunController@Upassword')->name('setting.password');
    Route::post("/admob", 'Admin\SettingAkunController@svadmob')->name('setting.admob');
    Route::put("/admob/{id}", 'Admin\SettingAkunController@upadmob')->name('setting.admob.update');
});
Auth::routes(['register' => false]);


