<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kelas;
use App\Tingkat;
use Response;
use Session;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $KelasTable;
    protected $TingkatTable;

    function __construct(){
        $this->middleware('auth');
        $this->KelasTable = new Kelas();
        $this->TingkatTable = new Tingkat();
    }

   public function index()
    {
        $data = $this->data();
        $tingkat = $this->tingkat();
        $active = "kelas";
        return view('content.kelas.kelas', compact('data', 'tingkat', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(){
        return $this->KelasTable->orderByDesc('id')->get();
    }
    public function tingkat(){
        return $this->TingkatTable->orderBy('title', 'ASC')->get();
    } 
    public function create()
    {
        $data = $this->TingkatTable->orderBy('id', 'ASC')->get();
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
            'tingkat_id'   => 'required',
            'title'        => 'required|unique:kelas|max:191',
            'status_kelas' => 'required'
        ]);
        $all = $r->all();
        $data = $this->KelasTable->create($all);
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
        $data = $this->KelasTable->find($data_id);
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
        $datafind = $this->KelasTable->find($data_id);
        $data = $this->data();
        $tingkat = $this->tingkat();
        $active = "kelas";
        return view('content.kelas.edit', compact('data', 'tingkat', 'datafind', 'id', 'active'));

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
            'tingkat_id'   => 'required',
            'title'        => 'required|max:191',
            'status_kelas' => 'required',
            'jenis_kelas' => 'required'
        ]);
        $data_id = base64_decode($id);
        $data = $this->KelasTable->find($data_id);
        $data->tingkat_id = $r->tingkat_id;
        $data->title = $r->title;
        $data->status_kelas = $r->status_kelas;
        $data->jenis_kelas = $r->jenis_kelas;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/kelas');
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
        $data = $this->KelasTable->find($data_id)->delete();
        $pesan = 'dihapus!';
        if($data){
            return Response::json(['sukses' => 'data berhasil '.$pesan], 200);
        }else{
            return Response::json(['gagal' => 'data gagal '.$pesan], 200);
        }
    }
}
