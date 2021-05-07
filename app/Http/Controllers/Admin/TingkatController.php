<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tingkat;
use Response;
use Session;

class TingkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $TingkatTable;

    function __construct(){
        $this->middleware('auth');
        $this->TingkatTable = new Tingkat();
    }

   public function index()
    {
        $data = $this->data();
        $active = "tingkat";
        return view('content.tingkat.tingkat', compact('data', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        return $this->TingkatTable->orderByDesc('id')->get();
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
            'title'          => 'required|unique:tingkats|max:191',
            'status_tingkat' => 'required'
        ]);
        $all = $r->all();
        $data = $this->TingkatTable->create($all);
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
        $datafind = $this->TingkatTable->find($data_id);
        $active = "tingkat";
        return view('content.tingkat.show', compact('data', 'datafind', 'id', 'active'));
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
        $datafind = $this->TingkatTable->find($data_id);
        $active = "tingkat";
        return view('content.tingkat.edit', compact('data', 'datafind', 'id', 'active'));

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
        $data = $this->TingkatTable->find($data_id);
        $data->title = $r->title;
        $data->status_tingkat = $r->status_tingkat;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/tingkat');
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
        $data = $this->TingkatTable->find($data_id)->delete();
        $pesan = 'dihapus!';
         if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/tingkat');
    }
}
