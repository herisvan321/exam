<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Paket;
use Session;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $PaketTable;

    public function __construct(){
        $this->middleware('auth');
        $this->PaketTable = new Paket();
    }

    public function index($id)
    {
        $data_id = base64_decode($data_id);
        $data = $this->data($data_id);
        return $data;
    }

    public function data($id){
        return $this->PaketTable->where('ujian_id', $id)->orderBy('title', 'ASC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'title'          => 'required|max:191',
            'status_paket' => 'required'
        ]);
        $data_id = base64_decode($r->ujian_id);
        $all = $r->all();
        $all['ujian_id'] = $data_id;
        $data = $this->PaketTable->create($all);
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
        $datafind = $this->PaketTable->find($data_id);
        $active = "ujian";
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
        $datafind = $this->PaketTable->find($data_id);
        $data = $this->PaketTable->where('ujian_id', $datafind->ujian_id)->orderBy('title', 'ASC')->get();
        $active = "ujian";
        return view('content.paket.edit', compact('data', 'datafind', 'id', 'active'));
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
            'status_paket' => 'required'
        ]);

        $data_id = base64_decode($id); 
        $data = $this->PaketTable->find($data_id);
        $data->title = $r->title;
        $data->status_paket = $r->status_paket;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/ujian/paket/'.base64_encode($data->ujian_id));
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
        $data = $this->PaketTable->find($data_id)->delete();
        $pesan = 'dihapus!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/periode');
    }
}
