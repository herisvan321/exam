<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::any('/ceknetwork', 'Api\AuthController@index');
Route::any('/register', 'Api\AuthController@register');
Route::any('/login', 'Api\AuthController@login');
Route::any('/tingkat', 'Api\AuthController@getTingkat');
Route::post('/kelas', 'Api\AuthController@getKelas'); // lable tingkat_id

Route::prefix('/home')->group(function(){
	Route::any('/', 'Api\HomeApiController@index');
	Route::any('/logout', 'Api\HomeApiController@logout');
	Route::post('/fullberita', 'Api\HomeApiController@fullBerita');
	Route::post('/fullpengumuman', 'Api\HomeApiController@fullPengumuman');
	Route::post('/detail/pengumuman/{id}', 'Api\HomeApiController@detailPengumuman');
	Route::post('/detail/berita/{id}', 'Api\HomeApiController@detailBerita');

	Route::post('/history/login', 'Api\HomeApiController@historyLogin');
	Route::post('/history/ujian', 'Api\HomeApiController@historyUjian');
	
	Route::post('/list/ujian', 'Api\HomeApiController@listUjian');

	Route::post('/ujian/lobby/data/{id}', 'Api\HomeApiController@lobbyUjian');
	Route::post('/ujian/lobby/history/{id}', 'Api\HomeApiController@cekHistoryUjian');

	Route::post('/ujian/detail/history/{id}', 'Api\HomeApiController@detailHistoryUjian');
	Route::post('/ujian/checkin/{id}', 'Api\HomeApiController@checkInUjian');
	Route::post("/ujian/{hjid}/paket/{pid}/soal/{sid}", 'Api\HomeApiController@ujian');
	Route::post("/ujian/jawaban/{id}", 'Api\HomeApiController@simpanJawaban'); // lable soal_id, jawaban
	Route::post("/ujian/list/soal/{id}/{hjid}", 'Api\HomeApiController@listSoal'); // lable soal_id
	Route::post("/ujian/selesai/{hjid}", 'Api\HomeApiController@simpanUjian');
	Route::post("/ujian/nilai/peserta/{hjid}", 'Api\HomeApiController@nilaiPeserta');

	Route::post('/profile', 'Api\HomeApiController@getProfile');
	Route::post('/profile/update', 'Api\HomeApiController@updateProfile');// lable 'nama_depan' nama_belakang tmp_lahir tgl_lahir nohp alamat' 

	Route::post('/check/password', 'Api\HomeApiController@cekPassword'); // lable password
	Route::post('/update/password', 'Api\HomeApiController@UpdatePassword'); // lable password

	Route::post('/rank/list/{id}', 'Api\HomeApiController@rankList');
	Route::post("/lapor/hama", "Api\HomeApiController@laporHama"); // lable laporan
});
