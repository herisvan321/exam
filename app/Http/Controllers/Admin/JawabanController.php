<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jawaban;
use App\BankSoal;
use Response;
use Session;
use Str;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\JawabanImport;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $JawabanTable;
    protected $BankSoalTable;

    function __construct(){
        $this->middleware('auth');
        $this->JawabanTable = new Jawaban();
        $this->BankSoalTable = new BankSoal;
    }
    public function index($id)
    {
        $data_id = base64_decode($id);
        $data = $this->JawabanTable->where('bsoal_id',$data_id)->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data_id = base64_decode($id);
        return $data_id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $this->validate($r,[
            'bsoal_id' => 'required',
            'objectif' => 'required',
            'content' => 'required',
        ]);
        $data_id = base64_decode($r->bsoal_id);
        $all = $r->all();
        $jawaban = "";
        $aliasFile = "";
        $random = Str::random(5);
        $fileStatus = false;
        if($r->jenis_soal == 0 || $r->jenis_soal == 4 || $r->jenis_soal == 5 || $r->jenis_soal == 6) :
            $jawaban = $r->content;
        elseif($r->jenis_soal == 1 || $r->jenis_soal == 7 || $r->jenis_soal == 11 || $r->jenis_soal == 15) :
            $aliasFile = "JAWABAN-IMAGE-".date("dmYHis-").$random;
            $fileStatus = true;
        elseif($r->jenis_soal == 2 || $r->jenis_soal == 8 || $r->jenis_soal == 10 || $r->jenis_soal == 14) :
            $aliasFile = "JAWABAN-AUDIO-".date("dmYHis-").$random;
            $fileStatus = true;
        elseif($r->jenis_soal == 3 || $r->jenis_soal == 9 || $r->jenis_soal == 12 || $r->jenis_soal == 13) :
            $aliasFile = "JAWABAN-VIDEO-".date("dmYHis-").$random;
            $fileStatus = true;
        endif;

        if($fileStatus == true){
            $file = $r->file('content');
            if($file->isValid()){
                $ext = $file->getClientOriginalExtension();
                $namefile = $aliasFile.".$ext";
                $all['content'] = $namefile;
                $file->move("upload/banksoal/", $namefile);
            }else{
                Session::flash("gagal", "file not valid");
                return back();
            }
        }

        $all['bsoal_id'] = $data_id;
        $all['objectif'] = strtoupper($r->objectif);

        $data = $this->JawabanTable->create($all);
        $pesan = 'disimpan!';
        if($data){
            Session::flash('sukses' , 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal' , 'data gagal '.$pesan);
        }
        return redirect('/home/soal/jawaban/data/'.$r->bsoal_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_id = base64_decode($id);
        $data = $this->JawabanTable->find($data_id);
        $datafind = $this->BankSoalTable->find($data->bsoal_id);
        $active = "soal";
        return view('content.soal.showjawaban', compact('data', 'datafind', 'id', 'active'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_id = base64_decode($id);
        $data = $this->JawabanTable->find($data_id);
        $datafind = $this->BankSoalTable->find($data->bsoal_id);
        return view('content.soal.editjawaban', compact('data', 'datafind', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $this->validate($r,[
            'objectif' => 'required',
            'content' => 'required',
        ]);
        // return $r->all();
        $data_id = base64_decode($id);
        $data = $this->JawabanTable->find($data_id);
        $data->objectif = strtoupper($r->objectif);
        $data->content = $r->content;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses' , 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal' , 'data gagal '.$pesan);
        }
        return redirect('/home/soal/jawaban/data/'.base64_encode($data->bsoal_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_id = base64_decode($id);
        $data = $this->JawabanTable->find($data_id);
        $bsoal = $data->bsoal_id;
        $target = "upload/banksoal/".$data->content;
        if(file_exists($target)){
            unlink($target);
        }
        $data->delete();
        $pesan = 'dihapus!';
        if($data){
            Session::flash('sukses' , 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal' , 'data gagal '.$pesan);
        }
        return redirect('/home/soal/jawaban/data/'.base64_encode($bsoal));
    }

    public function importJawabanText(Request $request, $id){
        // $this->validate($request, [
        //     'file' => 'required|mimes:csv,xls,xlsx'
        // ]);

        $data_id = base64_decode($id);

        $file = $request->file('file');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move('upload/',$nama_file);
        $input = Excel::import(new JawabanImport($data_id), 'upload/'.$nama_file);
        
        $target = 'upload/'.$nama_file;
        if(file_exists($target)) :
            unlink($target);
        endif;
        if($input){
            Session::flash('sukses', 'Data  Berhasil diImport!');
        }else{
            Session::flash('gagal', 'Data  Gagal diImport!');
        }
        return back();
    }
}
