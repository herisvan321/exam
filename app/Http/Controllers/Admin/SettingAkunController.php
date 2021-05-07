<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\AdmobModel;
use Auth;
use Response;
use Hash;
use Session;

class SettingAkunController extends Controller
{
    protected $UserTable;
    protected $AdmobTable;

    public function __construct(){
        $this->middleware('auth');
    	$this->UserTable = new User();
        $this->AdmobTable = new AdmobModel();
    }

    public function index(){
    	$data = Auth::user();
        $admob = $this->AdmobTable->first();
        $active = "setting"; 
    	return view('content.setting.home', compact('data', 'active', 'admob'));
    }

    public function svadmob(Request $r){
        $all = $r->all();
        $data = $this->AdmobTable->create($all);
        $pesan = 'disimpan!';
        if($data){
            Session::flash('sukses', 'Admob berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'Admob gagal '.$pesan);
        }
        return back();
    }

    public function upadmob(Request $r, $id){
        $data_id = base64_decode($id);
        $data = $this->AdmobTable->find($data_id);
        $data->id_application = $r->id_application;
        $data->status_banner = $r->status_banner;
        $data->id_banner = $r->id_banner;
        $data->status_tayang = $r->status_tayang;
        $data->id_tayang= $r->id_tayang;
        $data->status_native = $r->status_native;
        $data->id_native = $r->id_native;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'Admob berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'Admob gagal '.$pesan);
        }
        return back();
    }

    public function upUsername(Request $r, $id){
    	$this->validate($r,[
    		'name' => 'required|max:191' 
    	]);

    	$data_id = base64_decode($id);
    	$data = $this->UserTable->find($data_id);
    	$data->name = $r->name;
    	$data->update();
    	$pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'username berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'username gagal '.$pesan);
        }
        return back();
    }

    public function Upassword(Request $r, $id){
    	$this->validate($r,[
    		'password' => 'required|max:191' 
    	]);

    	$data_id = base64_decode($id);
    	$data = $this->UserTable->find($data_id);
    	$data->password = Hash::make($r->password);
    	$data->update();
    	$pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'password berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'password gagal '.$pesan);
        }
        return back();
    }
}
