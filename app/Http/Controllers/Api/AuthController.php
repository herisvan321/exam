<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Peserta;
use App\Tingkat;
use App\Kelas;
use Response;
use Hash;
use Validator;
use Auth;


use App\HistoryLogin;


use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    protected $historyLoginTable;
    protected $tingkatTable;
    protected $kelasTable;
    

    public function __construct(){
        $this->historyLoginTable = new HistoryLogin();
        $this->tingkatTable      = new Tingkat();
        $this->kelasTable        = new Kelas();
        
    }
	public function index(){
		$status = true;
		$message= "anda berhasil terhubung";
        
		return Response::json([
			'status' => $status,
			'message' => $message
		]);
	}
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! Auth::guard('peserta')->attempt($credentials)) {
            	$status = false;
            	$message = 'invalid_credentials';
                return response()->json(['status' => $status, 'message' => $message], 200);
            }

        } catch (JWTException $e) {
        	$status = false;
            $message = 'could_not_create_token';
            return response()->json(['status' => $status, 'message' => $message], 500);
        }

        $user = Auth::guard('peserta')->user();


        $datalogin = [
            'peserta_id' => $user->id
        ];

        // return $datalogin;

        $this->historyLoginTable->create($datalogin);

        $token = JWTAuth::fromUser($user);

        $status = true;
        $message = 'berhasil login!';

        return response()->json([
        	'status' => $status,
        	'message'=> $message,
        	'token' => $token
        ],200);
    }
    public function register(Request $request){

    	$validator = Validator::make($request->all(), [
    		'tingkat_id' => 'required',
            'kelas_id' => 'required',
            'email' => 'required|unique:pesertas',
            'password' => 'required',
            'nama_depan' => 'required',
            'nama_belakang' => 'required'
            // 'tmp_lahir' => 'required',
            // 'tgl_lahir' => 'required',
            // 'nohp' => 'required',
            // 'alamat' => 'required',
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

    	$kdepan = substr($request->nama_depan, 0, 1);
    	$kbelakang = substr($request->nama_belakang, 0, 1);

    	$all = $request->all();
    	$all['password'] = Hash::make($request->password);
    	$all['color'] = '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);
    	$all['is_name'] = strtoupper($kdepan.$kbelakang);
        $all['tmp_lahir'] = 'other';
        $all['tgl_lahir'] = date("Y-m-d");
        $all['nohp'] = 'other';
        $all['alamat'] = 'other';



    	$user = Peserta::create($all);

    	$token = JWTAuth::fromUser($user);

        $datalogin = [
            'peserta_id' => $user->id
        ];

        $this->historyLoginTable->create($datalogin);

    	$status = true;
    	$message = "berhasil register";

    	return Response::json([
    		'status' => $status,
    		'message' => $message,
    		'token' => $token
    	]);

    }

    public function getTingkat(){
        $status = true;
        $message = "data berhasil didapatkan";

        $data = $this->tingkatTable
        ->where('status_tingkat', "1")
        ->get();

        return Response::json(compact('status', 'message', 'data'), 200);
    }

    public function getKelas(Request $r){
        $status = true;
        $message = "data berhasil didapatkan";

        $data = $this->kelasTable
        ->where("tingkat_id", $r->tingkat_id)
        ->where("jenis_kelas", "1")
        ->get();

        return Response::json(compact('status', 'message', 'data'), 200);
    }

    
}
