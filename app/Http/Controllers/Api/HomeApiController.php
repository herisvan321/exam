<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Berita;
use App\Pengumuman;
use App\HistoryLogin;
use App\HistoryUjian;
use App\Periode;
use App\AdmobModel;

use App\Ujian;
use App\Kelas;
use App\Matpel;
use App\Paket;
use App\Soal;
use App\BankSoal;
use App\Jawaban;
use App\JawabPeserta;
use App\Peserta;
use App\LaporanHamaModel;
use Validator;
use Auth;
use Response;
use Hash;
use Carbon\Carbon;
use DB;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class HomeApiController extends Controller
{
	protected $pengumumanTable;
	protected $beritaTable;
	protected $historyLoginTable;
	protected $historyUjianTable;
	protected $periodeTable;
	protected $ujianTable;
	protected $kelasTable;
	protected $matpelTable;
	protected $paketTable;
	protected $soalTable;
	protected $bankSoalTable;
	protected $JawabanTable;
	protected $JawabanPesertaTable;
	protected $pesertaTable;
	protected $LaporanHamaTable;
	protected $AdmobTable;

	public function __construct(){
		$this->middleware("jwt.peserta");
		$this->pengumumanTable     = new Pengumuman();
		$this->beritaTable         = new Berita();
		$this->historyLoginTable   = new HistoryLogin();
		$this->historyUjianTable   = new HistoryUjian();
		$this->periodeTable        = new Periode();
		$this->ujianTable          = new Ujian();
		$this->kelasTable          = new Kelas();
		$this->matpelTable         = new Matpel();
		$this->paketTable          = new Paket();
		$this->soalTable           = new Soal();
		$this->bankSoalTable       = new BankSoal;
		$this->JawabanTable        = new Jawaban();
		$this->JawabanPesertaTable = new JawabPeserta();
		$this->JawabanPesertaTable = new JawabPeserta();
		$this->pesertaTable        = new Peserta();
		$this->LaporanHamaTable    = new LaporanHamaModel();
		$this->AdmobTable          = new AdmobModel();
	}

    public function index(Request $r){
    	// return $r->all();
    	
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }
          
	    $status = true;
	    $message = "data didapatkan!";

	    $data = [];
	    $tingkat = $user->pesertaTingkat;
	    $kelas = $user->pesertaKelas;
		
	    $data = $user;
	    
	    $pengumuman = $this->pengumumanTable
	    ->where('tingkat_id', $user->tingkat_id)
	    ->orWhere('tingkat_id', "0")
	    ->orderByDesc('id')
	    ->limit(7)
	    ->get();
	    $dataP = [];
	    foreach($pengumuman as $key => $d){
	    	$dataP[$key] = $d;
	    	$dataP[$key]->vformatdateC = date("d-F-Y", strtotime($d->created_at));
	    	$data->pengumuman = $dataP;
	    }

	    $berita = $this->beritaTable
	    ->where('status_berita', 'PUBLIC')
	    ->orderByDesc('id')
	    ->limit(7)
	    ->get();
	    $data1 = [];
	    foreach($berita as $key => $v){
	    	$data1[$key] = $v;
	    	$data1[$key]->vformatdateC = date("d-F-Y", strtotime($v->created_at));
	    	$data->berita = $data1;
	    }
		$admob = $this->AdmobTable->first();

	    return Response::json(compact('status','message','data','admob'), 200);
    }

    public function getProfile(){
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }
          

	    $status = true;
	    $message = "data didapatkan!";
	    $data = $user;
	    $data["formatdateC"] = date("d-m-Y H:i:s", strtotime($data->created_at));
	    $data["formatdateD"] = date("d-m-Y H:i:s", strtotime($data->updated_at));
	    // return $formatdateC;

	    return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function updateProfile(Request $request){
    	$validator = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
    	]);

    	if($validator->fails()){
    		$status = false;
    		$message = "validate error";
    		return Response::json([
    			'status' => $status,
    			'$message' => $message,
    			'data' => $validator->errors()->toJson()
    		]);
    	}

    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        } 
        $kdepan = substr($request->nama_depan, 0, 1);
    	$kbelakang = substr($request->nama_belakang, 0, 1);

    	$up = $this->pesertaTable->find($user->id);
		$up->nama_depan    = $request->nama_depan;
		$up->nama_belakang = $request->nama_belakang;
		$up->tmp_lahir     = $request->tmp_lahir;
		$up->tgl_lahir     = $request->tgl_lahir;
		$up->nohp          = $request->nohp;
		$up->is_name 	   = strtoupper($kdepan.$kbelakang);
		$up->alamat        = $request->alamat;
		if($request->password != ""){
			$up->password = Hash::make($request->password);
		}
		$up->update();

		if($up){
			$status = true;
        	$message = 'data berhasi diupdate';
		}else{
			$status = false;
        	$message = 'data gagal diupdate';
		}

		return Response::json(compact('status', 'message'), 200);
    }

    public function cekPassword(Request $r){
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }


	    $cekdata = $this->pesertaTable->find($user->id);


	    if($cekdata->password == Hash::make($r->password)){
	    	$status = true;
	    	$message = "password benar!";
	    }else{
	    	$status = false;
	    	$message = "password salah!";
	    }

	    return Response::json(compact('status', 'message'), 200);
    }

    public function UpdatePassword(Request $r){
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }
          

	    $up = $this->pesertaTable->find($user->id);
	    $up->password = Hash::make($r->password);
	    $up->update();

	    if($up){
	    	$status = true;
	    	$message = "password berhasil diUpdate!";
	    }else{
	    	$status = false;
	    	$message = "password gagal diUpdate!";
	    }

	    return Response::json(compact('status', 'message'), 200);
    }



    public function fullBerita(){
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        } 

    	$status = true;
	    $message = "data didapatkan!";

	    $data = [];
	    $berita = $this->beritaTable
	    ->where('status_berita', 'PUBLIC')
	    ->orderByDesc('id')
	    ->get();

	    foreach($berita as $key => $d){
	    	$data[$key] = $d;
	    	$data[$key]->vformatdateC = date("d-F-Y", strtotime($d->created_at));
	    }

	    return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function fullPengumuman(){
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

	    $status = true;
	    $message = "data didapatkan!";

	    
	    $data = [];
	    $pengumuman = $this->pengumumanTable
	    ->where('tingkat_id', $user->tingkat_id)
	    ->orWhere('tingkat_id', "0")
	    ->orderByDesc('id')
	    ->get();

	    foreach($pengumuman as $key => $d){
	    	$data[$key] = $d;
	    	$data[$key]->vformatdateC = date("d-F-Y", strtotime($d->created_at));
	    }

	    return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function detailBerita($id){
    	$data_id = $id;
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  
    	$status = true;
    	$message = "data didapatkan!";
    	$data = $this->beritaTable->find($data_id);
    	$data->vformatdateC = date("d-F-Y", strtotime($data->created_at));
    	return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function detailPengumuman($id){
    	$data_id = $id;
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  
    	$status = true;
    	$message = "data didapatkan!";
    	$data = $this->pengumumanTable->find($data_id);
    	$data->vformatdateC = date("d-F-Y", strtotime($data->created_at));
    	return Response::json(compact('status', 'message', 'data'), 200);
    }



    public function historyLogin(){
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
          
        }
	    $data = [];
	    $his = $this->historyLoginTable
	    ->where('peserta_id', $user->id)
	    ->orderByDesc('id')
	    ->limit(21)
	    ->get();
	    foreach ($his as $key => $v) {
	    	$data[$key] = $v;
	    	$m = date("d-m-Y H:i:s", strtotime($v->created_at));
	    	$data[$key]->format_time = $m;
	    }

	    $status = true;
    	$message = "data didapatkan!";
    	return Response::json(compact('status', 'message', 'data'), 200);

    }

    public function listUjian(){
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
          
        }
	    $status = true;
	    $message = "data didapatkan!";

	    $data = [];

	    $kelasjurusan = $this->kelasTable->find($user->kelas_id);
	    $kelasumum = $this->kelasTable
	    ->where('tingkat_id', $user->tingkat_id)
	    ->where('jenis_kelas', "0")
	    ->first();
	    $matpel = $this->matpelTable
	    ->where('kelas_id', $kelasjurusan->id)
	    ->where('status_matpel', "1")
	    ->orWhere('kelas_id', $kelasumum->id)
	    ->where('status_matpel', "1")
	    ->orderByDesc('id')
	    ->get();



	    foreach ($matpel as $key => $v) {
	    	$data[] = $v;
	    	$data[$key]->ujian = $this->ujianTable
	    	->where('matpel_id', $v->id)
	    	->where('status_ujian', 1)
	    	->orderByDesc('id')
	    	->get();
	    }
    	return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function lobbyUjian($id){
    	$data_id = $id;
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
          
        }
    	$status = true;
	    $message = "data didapatkan!";

	    $data = $this->ujianTable->find($data_id);

	    return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function checkInUjian($id){
    	$data_id = $id;
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

	    $status = true;
	    $message = "data berhasil didapatkan";

	    $ujian = $this->ujianTable->find($data_id);

	    $paket = $this->paketTable->where('ujian_id', $data_id)
	    ->inRandomOrder()
        ->first();

        $cekujian = $this->historyUjianTable
        ->where('peserta_id', $user->id)
        ->where('ujian_id', $data_id)
        ->where('status_ujian', "0")
        ->orderByDesc('id')
        ->first();
        // return $cekujian->paket_id;

        if(@count($cekujian) > 0){
        	$status = true;

        	$message = "data berhasil didapatkan";
        	$ceksoal = $this->soalTable
        	->where('paket_id', $cekujian->paket_id)
        	->orderBy("nourut","ASC")
        	->first();

        	$tahun = date("Y", strtotime($cekujian->batas_waktu));
        	$bulan = date("m", strtotime($cekujian->batas_waktu));
        	$hari = date("d", strtotime($cekujian->batas_waktu));
        	$jam = date("H", strtotime($cekujian->batas_waktu));
        	$menit = date("i", strtotime($cekujian->batas_waktu));
        	$detik = date("s", strtotime($cekujian->batas_waktu));


        	$data = [
        		"status" => $status,
        		"message" => $message, 
        		"ujian_id" => $cekujian->id,
	    		"paket_id" => $ceksoal->paket_id,
	    		"soal_id" => $ceksoal->id,
	    		"tahun" => $tahun,
	    		"bulan" => $bulan,
	    		"hari" => $hari,
	    		"jam" => $jam,
	    		"menit" => $menit,
	    		"detik" => $detik
        	];

        	return Response::json(compact('status', 'message', 'data'), 200);
        }



        $cekhistory = $this->historyUjianTable
        ->where('peserta_id', $user->id)
        ->where('ujian_id', $data_id)
        ->orderByDesc('id')
        ->first();

        if(@count($cekhistory) > 0){
        	$ujianke = $cekhistory->ujian_ke + 1;
        }else{
        	$ujianke = 1;
        }

	    $all = [
	    	'peserta_id' => $user->id,
            'paket_id' => $paket->id,
            'ujian_id' => $data_id,
            'ujian_ke' => $ujianke,
            'waktu_mulai' => Carbon::now(),
            'batas_waktu' => Carbon::now()->addMinutes($ujian->alokasi_waktu) ,
            'status_ujian' => "0",
	    ];



	    $simpan = $this->historyUjianTable->create($all);

	    $cekujian1 = $this->historyUjianTable
        ->where('peserta_id', $user->id)
        ->where('ujian_id', $data_id)
        ->where('status_ujian', "0")
        ->orderByDesc('id')
        ->first();


	    $ceksoal = $this->soalTable
    	->where('paket_id', $cekujian1->paket_id)
    	->orderBy("nourut","ASC")
    	->first();


	 	$tahun = date("Y", strtotime($cekujian1->batas_waktu));
    	$bulan = date("m", strtotime($cekujian1->batas_waktu));
    	$hari = date("d", strtotime($cekujian1->batas_waktu));
    	$jam = date("H", strtotime($cekujian1->batas_waktu));
    	$menit = date("i", strtotime($cekujian1->batas_waktu));
    	$detik = date("s", strtotime($cekujian1->batas_waktu));


    	$data = [
    		"status" => $status,
    		"message" => $message, 
    		"ujian_id" => $cekujian1->id,
    		"paket_id" => $ceksoal->paket_id,
    		"soal_id" => $ceksoal->id,
    		"tahun" => $tahun,
    		"bulan" => $bulan,
    		"hari" => $hari,
    		"jam" => $jam,
    		"menit" => $menit,
    		"detik" => $detik
    	];

	    return Response::json(compact('status', 'message', 'data'), 200);


    }

    public function ujian($hjid, $pid, $sid){
    	$hujian_id = $hjid;
    	$paket_id = $pid;
    	$soal_id = $sid;

    	$cekwaktu = $this->historyUjianTable->find($hujian_id);

    	if(date("YmdHis") >= date("YmdHis", strtotime($cekwaktu->batas_waktu))){
    		$status = false;
    		$message = "waktu_habis";
    		return Response::json(compact('status', 'message'), 200);
    	}

    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

	    $status = true;
	    $message = "data didapatkan!";
	    $ceksoal = $this->soalTable->find($soal_id);
	    // return $ceksoal;
	    $data = $this->bankSoalTable->find($ceksoal->bsoal_id);
	    $jawaban = $data->bsJawaban;

	    
	    $datanext = [];
	    $dataprev = [];

	    $ijawaban = $this->JawabanPesertaTable->where("hujian_id", $hujian_id)->where("soal_id", $soal_id)->first();

	    if(@count($ijawaban) > 0){
	    	$status_jawban = true;
	    }else{
	    	$status_jawban = false;
	    }
	    
	    $mJawaban = [
	    	"status_jawaban" => $status_jawban,
	    	"message" => "data didapatkan",
	    	"data_jawaban" => $ijawaban
	    ]; 

	    $next = $this->soalTable
	    ->where('paket_id', $paket_id)
	    ->where('id', '>', $soal_id)
    	->orderBy('id', 'ASC')
    	->first();

    	$prev = $this->soalTable
	    ->where('paket_id', $paket_id)
	    ->where('id', '<', $soal_id)
    	->orderBy('id', 'DESC')
    	->first();

    	if(@count($next) > 0){
    		$datanext = [
    			'kondisinext' => true,
    			"ujiannext" =>  $hujian_id,
    			"paketnext" => $paket_id,
    			"soalnext" => $next->id
    		];
    	}else{
    		$datanext = [
    			'kondisinext' => false,
    		];
    	}
    	if(@count($prev) > 0){
    		$dataprev = [
    			'kondisiprev' => true,
    			"ujianprev" =>  $hujian_id,
    			"paketprev" => $paket_id,
    			"soalprev" => $prev->id
    		];
    	}else{
    		$dataprev = [
    			'kondisiprev' => false,
    		];
    	}
	    return Response::json(compact('status', 'message', 'data', 'datanext', 'dataprev','mJawaban', 'hujian_id'), 200);

    }

    public function listSoal(Request $r, $id, $hjid){
    	$data_id = $id;
    	$hujian_id = $hjid;

    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

	    $status = true;
	    $message = "data didapatkan!";

	    $data = [];

	    $soals = $this->soalTable
	    ->where('paket_id', $data_id)
	    ->orderBy("nourut", "ASC")
	    ->get();

	    foreach ($soals as $key => $soal) {
	    	$data[] = $soal;
	    	if($soal->id == $r->soal_id){
	    		$dd = true;
	    	}else{
	    		$dd = false;
	    	}

	    	$data[$key]->no_sekarang = $dd;
	    	$jawaban = $this->JawabanPesertaTable
	    	->where('soal_id', $soal->id)
	    	->where('hujian_id', $hujian_id)
	    	->first();

	    	if(@count($jawaban) > 0){
	    		$kondisi = true;
	    	}else{
	    		$kondisi = false;
	    	}

	    	$data[$key]->kondisi = $kondisi;
	    	$data[$key]->jawaban = $jawaban;
	    }

	    return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function simpanJawaban(Request $r, $hjid){
    	$hujian_id = $hjid;

    	$cekwaktu = $this->historyUjianTable->find($hujian_id);

    	if(date("YmdHis") >= date("YmdHis", strtotime($cekwaktu->batas_waktu))){
    		$status = false;
    		$message = "waktu_habis";
    		return Response::json(compact('status', 'message'), 200);
    	}

    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

    	$cekjawaban = $this->JawabanPesertaTable
    	->where('hujian_id', $hujian_id)
    	->where('soal_id', $r->soal_id)
    	->first();

    	$ceksoal = $this->soalTable->find($r->soal_id);
    	
    	$cekkondisi = $this->bankSoalTable
    	->where('id', $ceksoal->bsoal_id)
    	->where('jawaban', strtoupper($r->jawaban))
    	->first();

		// return $cekkondisi;

    	if(@count($cekkondisi) > 0){
    		$skor = $cekkondisi->skor_soal;
    		$status_jawab = "BENAR";
    	}else{
    		$skor = 0;
    		$status_jawab = "SALAH";
    	}

    	if(@count($cekjawaban) > 0){
    		$in = $this->JawabanPesertaTable->find($cekjawaban->id);
    		$in->hujian_id = $hujian_id;
    		$in->soal_id = $r->soal_id;
    		$in->jawab = strtoupper($r->jawaban);
    		$in->skor = $skor;
    		$in->status_jawab = $status_jawab;
    		$in->update();

    		$status = true;
    		$message = "jawaban berhasil diupdate";
    		$data = $in;
    	}else{
    		$in = $this->JawabanPesertaTable;
    		$in->hujian_id = $hujian_id;
    		$in->soal_id = $r->soal_id;
    		$in->jawab = strtoupper($r->jawaban);
    		$in->skor = $skor;
    		$in->status_jawab = $status_jawab;
    		$in->save();

    		$status = true;
    		$message = "jawaban berhasil disimpan";
    		$data = $in;
    	}

    	return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function cekHistoryUjian($id){
    	$data_id = $id;
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

	    $status = true;
	    $message = "data didapatkan!";

	    $data = $this->historyUjianTable
	    ->where('peserta_id', $user->id)
	    ->where('ujian_id', $data_id)
	    ->orderByDesc("id")
	    ->get();

	    return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function detailHistoryUjian($id){
    	$data_id = $id;
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

	    $status = true;
	    $message = "data didapatkan!";

	    $data = $this->historyUjianTable
	    ->find($data_id);

	    return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function simpanUjian($hjid){
    	$hujian_id = $hjid;
    	$nilai = 0;

    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  




    	$ceknilai = $this->JawabanPesertaTable
    	->where("hujian_id", $hujian_id)
    	->get();

    	$cekbenar = $this->JawabanPesertaTable
    	->where("hujian_id", $hujian_id)
    	->where("status_jawab", "BENAR")
    	->count();

    	$ceksalah = $this->JawabanPesertaTable
    	->where("hujian_id", $hujian_id)
    	->where("status_jawab", "SALAH")
    	->count();

    	foreach ($ceknilai as $v) {
    		$nilai += $v->skor;
    	}

    	$up = $this->historyUjianTable->find($hujian_id);

    	$data = [];

	    $soals = $this->soalTable
	    ->where('paket_id', $up->paket_id)
	    ->orderBy("nourut", "ASC")
	    ->get();

	    foreach ($soals as $key => $soal) {
	    	$data[$key] = $soal;
	    	$jawaban = $this->JawabanPesertaTable
	    	->where("soal_id", $soal->id)
	    	->where('hujian_id', $hujian_id)
	    	->first();
	    	if(@count($jawaban) > 0){
	    		$kondisi = true;
	    	}else{
	    		$kondisi = false;
	    	}
	    	$data[$key]->jawaban = $jawaban;
	    	$data[$key]->kondisi = $kondisi;
	    }

	    $datkon = array_column($data, "kondisi");

	    $in_arr = in_array(false, $datkon);
	    // array_column($data, "kondisi");
	    //@count($data->id);

    	if(date("YmdHis") <= date("YmdHis", strtotime($up->batas_waktu)) && $in_arr){
    		$status = false;
    		$message = "masih_ada_waktu";
    		return Response::json(compact('status', 'message'), 200);
    	}

    	$up->waktu_selesai = Carbon::now();
    	$up->status_ujian = "1";
    	$up->benar = $cekbenar;
    	$up->salah = $ceksalah;
    	$up->nilai = $nilai;
    	$up->update();

    	$status = true;
	    $message = "berhasil diupdate";

	   
	    return Response::json(compact('status', 'message'), 200);


    }
    public function nilaiPeserta($hjid){
    	$hujian_id = $hjid;

    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

        $status = true;
        $message = "data didapatkan!";
        $data = $this->historyUjianTable->find($hujian_id);
        $dataujian = $data->historyUjianU;
        return Response::json(compact("status", "message", "data"));
    }

    public function historyUjian(){
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

        $status = true;
        $message = "data didapatkan!";
        $data =  [];
        $hisUjian = $this->historyUjianTable
        ->where("peserta_id", $user->id)
        ->select("ujian_id", DB::raw("count(*) as total"))
        ->groupBy("ujian_id")->get();

        foreach ($hisUjian as $key => $v) {
        	$data[$key] = $v;
        	$data[$key]->ujian = $this->ujianTable->find($v->ujian_id);

        }
        return Response::json(compact("status", "message", "data"));
    }

    public function rankList($id){
    	$history_id = $id;
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  

        $status = true;
        $message = "data didapatkan!";
        $cekdata = $this->historyUjianTable->find($history_id);
        $data =  [];
        $cekdata = $this->historyUjianTable
        ->where('ujian_id', $cekdata->ujian_id)
        ->where("ujian_ke", $cekdata->ujian_ke)
        ->where("status_ujian", "1")
        ->orderByDesc("nilai")
        ->limit(10)
        ->get();
        foreach ($cekdata as $key => $v) {
        	$data[] = $v;
        	$data[$key]->vpaket = $this->paketTable->find($v->paket_id);
        	$data[$key]->vpeserta = $this->pesertaTable->find($v->peserta_id);
        }
       
        return Response::json(compact("status", "message", "data"));
    }

    public function laporHama(Request $r){
    	try {
	        if (!$user = Auth::guard('peserta')->user()) {
	        	$status = false;
	        	$message = 'user_not_found';
	            return Response::json(compact('status', 'message'), 200);
	        }
	    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
	    	$status = false;
        	$message = 'token_expired';
            return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
	    	$status = false;
        	$message = 'token_invalid';
	        return Response::json(compact('status', 'message'), 200);
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	    	$status = false;
        	$message = 'token_absent';
        	return Response::json(compact('status', 'message'), 200);
        }  
        $validator = Validator::make($r->all(), [
            'laporan' => 'required'
    	]);

    	if($validator->fails()){
    		$status = false;
    		$message = "validate error";
    		return Response::json([
    			'status' => $status,
    			'$message' => $message,
    			'data' => $validator->errors()->toJson()
    		]);
    	}

        $status = true;
        $message = "data didapatkan!";

        $data = $this->LaporanHamaTable;
        $data->peserta_id = $user->id;
        $data->laporan = $r->laporan;
        $data->save();
        
       
        return Response::json(compact("status", "message", "data"));
    }

    public function logout(){
    	Auth::guard('peserta')->logout();
		$status = true;
		$message = "anda berhasi logout";
    	return Response::json([
    		'status' => $status,
    		'message' => $message
    	], 200);
    }


}
