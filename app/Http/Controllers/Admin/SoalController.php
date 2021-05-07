<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Soal;
use Response;
use Session;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $SoalTable;

    function __construct(){
        $this->middleware('auth');
        $this->SoalTable = new Soal();
    }

    public function index()
    {
        return view('content.soal.index');
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
        $countcheck = @count($r->checksoal);
        for ($i=0; $i < $countcheck; $i++) { 
            $data_id = base64_decode($r->checksoal[$i]);
            $cekdata = $this->SoalTable->where('paket_id', $r->paket_id)->orderByDesc('id')->first();
            if(@count($cekdata) > 0){
                $nourut = $cekdata->nourut + 1;
            }else{
                $nourut = 1;
            }
            $all = [
                'paket_id' => $r->paket_id,
                'bsoal_id' => $data_id,
                'nourut'   => $nourut
            ];
            $data = $this->SoalTable->create($all);
        }
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
        $data = $this->SoalTable->where('paket_id', $data_id)->get();
        $active = "ujian";
        return view('content.paket.datasoal', compact('data', 'active'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data_id = base64_decode($id);
        $data = $this->SoalTable->find($data_id)->delete();
        $pesan = 'dihapus!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return back();
    }
}
