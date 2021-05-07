<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Periode;
use Session;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $PeriodeTable;

    function __construct(){
        $this->middleware('auth');
        $this->PeriodeTable = new Periode();
    }
    public function index()
    {
        $data = $this->data();
        // foreach($data as $key => $dat){
        //     $ujian = $dat->periodeUjian;
        // }
        // return $data;
        $active = "periode";
        return view('content.periode.periode', compact('data', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        return $this->PeriodeTable->orderByDesc('id')->get();

    }
    public function create()
    {
        //
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
            'title'          => 'required|unique:periodes|max:191',
            'status_periode' => 'required'
        ]);
        $all = $r->all();
        $data = $this->PeriodeTable->create($all);
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
        $data = $this->data();
        $datafind = $this->PeriodeTable->find($data_id);
        $active = "periode";
        return view('content.periode.show', compact('data', 'datafind', 'id', 'active'));
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
        $data = $this->data();
        $datafind = $this->PeriodeTable->find($data_id);
        $active = "periode";
        return view('content.periode.edit', compact('data', 'datafind', 'id', 'active'));

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
            'title'          => 'required|max:191',
            'status_periode' => 'required'
        ]);

        $data_id = base64_decode($id); 
        $data = $this->PeriodeTable->find($data_id);
        $data->title = $r->title;
        $data->status_periode = $r->status_periode;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/periode');
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
        $data = $this->PeriodeTable->find($data_id)->delete();
        $pesan = 'dihapus!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/periode');
    }
}
