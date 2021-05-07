<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BankSoal;
use App\Tingkat;
use App\Kelas;
use App\Matpel;
use Response;
use Session;
use Str;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BankSoalImport;
use App\Imports\JawabanImportAll;


class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $TingkatTable;
    protected $KelasTable;
    protected $BankSoalTable;

    public function __construct(){
        $this->middleware('auth');
        $this->BankSoalTable = new BankSoal;
        $this->TingkatTable  = new Tingkat;
        $this->KelasTable    = new Kelas;
        $this->MatpelTable    = new Matpel;
    }
    public function index()
    {
        $data = $this->BankSoalTable->orderByDesc('id')->get();
        foreach($data as $dat){
            $jawaban = $dat->bsJawaban;
            $soal = $dat->bsSoal;
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['tingkat'] = $this->TingkatTable->orderByDesc('id')->get();
        $data['kelas'] = $this->KelasTable->orderByDesc('id')->get();
        return $data;
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
            'data_id' => 'required',
            'soal' => 'required',
            'jlm_jawaban' => 'required',
            'jawaban' => 'required',
            'skor_soal' => 'required',
            'lable' => 'required',
        ]);
        $all = $r->all();
        $kondisi = base64_decode($r->kondisi);
        $data_id = base64_decode($r->data_id);
        $all['matpel_id'] = $data_id;
        $cekmatpel = $this->MatpelTable->find($data_id);
        $all['tingkat_id'] = $cekmatpel->matpelKelas->tingkat_id;
        // dd($cekmatpel->matpelKelas);
        $type = 0;
        $jenis_soal = 0;
        $keterangan = "";
        if($kondisi == 'text'){
            // 
            $type = 0;
            $jenis_soal = 0;
        }elseif($kondisi == 'text-media'){
            //
            $type = 1;
            $jenis_soal = $r->jenis_soal;
        }elseif($kondisi == 'media-text'){
            //
            $type = 2;
            $jenis_soal = $r->jenis_soal;
            if($r->keterangan != null){
                $keterangan = $r->keterangan;
            }
        }elseif($kondisi == 'full-media'){
            //
            $type = 3;
            $jenis_soal = $r->jenis_soal;
            if($r->keterangan != null){
                $keterangan = $r->keterangan;
            }
        }

        if($kondisi == 'media-text' || $kondisi == 'full-media'){
            $file = $r->file('soal');
            if($file->isValid()){
                $ext = $file->getClientOriginalExtension();
                $random = Str::random(5);
                $namefile = "SOAL-".date("dmYHis-").$random.".$ext";
                $all['soal'] = $namefile;
                $file->move("upload/banksoal/", $namefile);
            }else{
                Session::flash("gagal", "file not valid");
                return back();
            }
        }
        $all['type_soal'] = $type;
        $all['jenis_soal'] = $jenis_soal;
        $all['keterangan'] = $keterangan;
        $data = $this->BankSoalTable->create($all);
        $pesan = 'disimpan!';
        if($data){
            Session::flash('sukses' , 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/soal/data/soal/'.$r->data_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data_id = $id;
        $data = $this->BankSoalTable->find($data_id);
        $jawaban = $data->bsJawaban;
        $soal = $data->bsSoal;
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_id = $id;
        $data = $this->BankSoalTable->find($data_id);
        $jawaban = $data->bsJawaban;
        $soal = $data->bsSoal;
        return $data;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_id = $id;
        $data = $this->BankSoalTable->find($data_id)->delete();
        $pesan = 'dihapus!';
        if($data){
            return Response::json(['sukses' => 'data berhasil '.$pesan], 200);
        }else{
            return Response::json(['gagal' => 'data gagal '.$pesan], 200);
        }
    }

    public function importSoal(Request $request, $kondisi, $id){
        $this->validate($request, [
            // 'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $data_id = base64_decode($id);

        $jenis = $request->jenis_soal;

        if($kondisi == "text"){
            $type_soal = 0;
        }elseif($kondisi == "textmedia"){
            $type_soal = 1;
        }elseif($kondisi == "mediatext"){
            $type_soal = 2;
        }elseif($kondisi == "fullmedia"){
            $type_soal = 3;
        }

        $cekmatpel = $this->MatpelTable->find($data_id);
        $cektingkat = $cekmatpel->matpelKelas->tingkat_id;

        $file = $request->file('file');
        $nama_file = rand().".".$file->getClientOriginalExtension();
        $file->move('upload/',$nama_file);
        $input = Excel::import(new BankSoalImport($type_soal, $jenis, $data_id, $cektingkat), 'upload/'.$nama_file);
        
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

    public function importJawabanAll(Request $request){
        $this->validate($request, [
            // 'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand().".".$file->getClientOriginalExtension();
        $file->move('upload/',$nama_file);
        $input = Excel::import(new JawabanImportAll(), 'upload/'.$nama_file);
        
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

    public function importMedia(Request $request){
        $this->validate($request, [
            // 'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $data = $request->file('file');
        foreach($data as $dat){
            $nama_file = $dat->getClientOriginalName();
            $dat->move('upload/banksoal/',$nama_file);
        }
        if($data){
            Session::flash('sukses', 'Data  Berhasil diImport!');
        }else{
            Session::flash('gagal', 'Data  Gagal diImport!');
        }
        return back();
    }

    public function NameMedia(Request $r){
        $active = "Name Media";
        $media = 0;
        $jlmmedia = 0;
        if(@count($r->submit) > 0){
            $media = $r->media;
            $jlmmedia = $r->jlmmedia;
        }
        return view('content.soal.namemedia',compact('media', 'jlmmedia', 'active'));

    }
}
