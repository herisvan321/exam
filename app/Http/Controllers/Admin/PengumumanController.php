<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengumuman;
use App\Tingkat;
use Response;
use Session;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $PengumumanTable;

    protected $TingkatTable;

    public function __construct(){
        $this->middleware('auth');
        $this->PengumumanTable = new Pengumuman();
        $this->TingkatTable = new Tingkat();
    }

    public function index()
    {
        $data = [];
        $dd = $this->PengumumanTable->orderByDesc('id')->get();
        $tingkat = $this->TingkatTable->get();
        $active = "pengumuman";
        foreach ($dd as $key => $v) {
            $data[] = $v;
            $data[$key]->vtingkat = $this->TingkatTable->find($v->tingkat_id);
        }
        return view('content.pengumuman.home', compact('data', 'active', 'tingkat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->TingkatTable->orderByDesc('id')->get();
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
            'title' => 'required|max:191',
            'tingkat_id' => 'required',
            'content' => 'required',
        ]);
        $all = $r->all();
        $data = $this->PengumumanTable->create($all);
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
        $datafind = $this->PengumumanTable->find($data_id);
        $dd = $this->PengumumanTable->orderByDesc('id')->get();
        $tingkat = $this->TingkatTable->get();
        $active = "pengumuman";
        foreach ($dd as $key => $v) {
            $data[] = $v;
            $data[$key]->vtingkat = $this->TingkatTable->find($v->tingkat_id);
        }
        return view('content.pengumuman.show', compact('data', 'active', 'tingkat', 'datafind'));
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
        $datafind = $this->PengumumanTable->find($data_id);
        $dd = $this->PengumumanTable->orderByDesc('id')->get();
        $tingkat = $this->TingkatTable->get();
        $active = "pengumuman";
        foreach ($dd as $key => $v) {
            $data[] = $v;
            $data[$key]->vtingkat = $this->TingkatTable->find($v->tingkat_id);
        }
        return view('content.pengumuman.edit', compact('data', 'active', 'tingkat', 'datafind'));
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
        $data_id = base64_decode($id);
        $data = $this->PengumumanTable->find($data_id);
        $data->title = $r->title;
        $data->tingkat_id = $r->tingkat_id;
        $data->content = $r->content;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/pengumuman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getDelete($id){
        $data_id = base64_decode($id);
        $datafind = $this->PengumumanTable->find($data_id);
        $dd = $this->PengumumanTable->orderByDesc('id')->get();
        $tingkat = $this->TingkatTable->get();
        $active = "pengumuman";
        foreach ($dd as $key => $v) {
            $data[] = $v;
            $data[$key]->vtingkat = $this->TingkatTable->find($v->tingkat_id);
        }
        return view('content.pengumuman.delete', compact('data', 'active', 'tingkat', 'datafind'));
    }
    public function destroy($id)
    {
        $data_id = base64_decode($id);
        $data = $this->PengumumanTable->find($data_id)->delete();
        $pesan = 'dihapus!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/pengumuman');
    }
}
