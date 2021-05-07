<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ujian;
use App\Periode;
use App\Kelas;
use App\Tingkat;
use Session;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $UjianTable;
    protected $PeriodeTable;
    protected $KelasTable;
    protected $TingkatTable;

    function __construct(){
        $this->middleware('auth');
        $this->UjianTable   = new Ujian();
        $this->PeriodeTable = new Periode();
        $this->KelasTable   = new Kelas();
        $this->TingkatTable = new Tingkat();
    }
    public function index()
    {
        $data = $this->UjianTable->orderByDesc('id')->get();
        foreach($data as $dat){
            $kelas = $dat->ujianKelas;
            $periode = $dat->ujianPeriode;
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
        $data['periode'] = $this->PeriodeTable->get();
        $data['kelas'] = $this->KelasTable->get();
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
            'matpel_id' => 'required',
            'periode_id' => 'required',
            'title' => 'required',
            'jlm_soal' => 'required',
            'description' => 'required',
            'status_ujian' => 'required',
            'alokasi_waktu' => 'required',
        ]);
        $all = $r->all();
        $data = $this->UjianTable->create($all);
        $pesan = 'disimpan!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return back();
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
        $data = $this->UjianTable->find($data_id);
        $kelas = $data->ujianKelas;
        $periode = $data->ujianPeriode;
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
        $data_id = base64_decode($id);
        $datafind = $this->UjianTable->find($data_id);
        $matpel = $this->TingkatTable->get();
        $periode = $this->PeriodeTable->where('status_periode', "1")->get();
        $data = $this->UjianTable->orderByDesc('id')->paginate(14);
        $active = "ujian";
        return view('content.ujian.edit', compact('datafind', 'matpel', 'periode', 'data', 'id', 'active'));
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
            'matpel_id' => 'required',
            'periode_id' => 'required',
            'title' => 'required',
            'jlm_soal' => 'required',
            'description' => 'required',
            'status_ujian' => 'required',
            'alokasi_waktu' => 'required',
        ]);

        $data_id = base64_decode($id);
        $data = $this->UjianTable->find($data_id);
        $data->matpel_id = $r->matpel_id;
        $data->periode_id = $r->periode_id;
        $data->title = $r->title;
        $data->jlm_soal = $r->jlm_soal;
        $data->description = $r->description;
        $data->alokasi_waktu = $r->alokasi_waktu;
        $data->status_ujian = $r->status_ujian;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/ujian');
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
        $data = $this->UjianTable->find($data_id)->delete();
        $pesan = 'dihapus!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/ujian');
    }
}
