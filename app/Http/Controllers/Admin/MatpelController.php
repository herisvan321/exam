<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Matpel;
use App\Tingkat;
use Session;

class MatpelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $MatpelTable;

    protected $KelasTable;

    public function __construct(){
        $this->middleware('auth');
        $this->MatpelTable = new Matpel();
        $this->TingkatTable = new Tingkat();
    }

    public function data(){
        return $this->MatpelTable->orderByDesc('id')->get();
    }

    public function tingkat(){
        return $this->TingkatTable->all();
    }

    public function index()
    { 
        $data = $this->data();
        $tingkat = $this->tingkat();
        $active = "matpel";
        return view('content.matpel.matpel', compact('data', 'tingkat', 'active'));
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
            'status_matpel' => 'required'
        ]);
        $all = $r->all();
        $data = $this->MatpelTable->create($all);
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
        $datafind = $this->MatpelTable->find($data_id);
        $active = "matpel";
        return view('content.matpel.show', compact('data', 'datafind', 'id', 'active'));
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
        $datafind = $this->MatpelTable->find($data_id);
        $tingkat = $this->tingkat();
        $active = "matpel";
        return view('content.matpel.edit', compact('data', 'datafind', 'id', 'tingkat', 'active'));
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
            'status_matpel' => 'required'
        ]);

        $data_id = base64_decode($id); 
        $data = $this->MatpelTable->find($data_id);
        $data->title = $r->title;
        $data->kelas_id = $r->kelas_id;
        $data->status_matpel = $r->status_matpel;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/matpel');
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
        $data = $this->MatpelTable->find($data_id)->delete();
        $pesan = 'dihapus!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/matpel');
    }
}
