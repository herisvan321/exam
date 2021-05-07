<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Berita;
use Session;


class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $BeritaTable;

    public function __construct(){
        $this->middleware('auth');
        $this->BeritaTable = new Berita;
    }
    public function index()
    {
        $data = $this->BeritaTable->orderByDesc('id')->get();
        $active = "berita";
        return view('content.berita.home', compact('data', 'active'));
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
            'title' => 'required|max:191',
            'description' => 'required|max:255',
            'content' => 'required',
            'is_cover' => 'required',
            'status_berita' => 'required'
        ]);

        $file = $r->file('is_cover');
        if($file->isValid()){
            $ext = $file->getClientOriginalExtension();
            $nameFile = "BRT-".date("d-m-Y-H-i-s").".$ext";
            $file->move('upload/berita/', $nameFile);
        }
        $all = $r->all();
        $all['is_cover'] = $nameFile;
        $data = $this->BeritaTable->create($all);
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
        $data = $this->BeritaTable->find($data_id);
        $active = "berita";
        return view('content.berita.show', compact('data', 'active'));
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
        $data = $this->BeritaTable->orderByDesc('id')->get();
        $datafind = $this->BeritaTable->find($data_id);
        $active = "berita";
        return view('content.berita.edit', compact('data', 'active', 'datafind'));
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
        // return $r->all();
        $data_id = base64_decode($id);
        $data = $this->BeritaTable->find($data_id);
        $data->title = $r->title;
        $data->description = $r->description;
        $data->content = $r->content;
        if($r->file('is_cover') != NULL){
            $target = "upload/berita/".$data->is_cover;
            if(file_exists($target)){
                unlink($target);
            }
            $file = $r->file('is_cover');
            if($file->isValid()){
                $ext = $file->getClientOriginalExtension();
                $nameFile = "BRT-".date("d-m-Y-H-i-s").".$ext";
                $file->move('upload/berita/', $nameFile);
            }
            $data->is_cover = $nameFile;
        }
        $data->status_berita = $r->status_berita;
        $data->update();
        $pesan = 'diupdate!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/berita');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getDelete($id){
        $data_id = base64_decode($id);
        $data = $this->BeritaTable->orderByDesc('id')->get();
        $datafind = $this->BeritaTable->find($data_id);
        $active = "berita";
        return view('content.berita.delete', compact('data', 'active', 'datafind'));
    }
    public function destroy($id)
    {
        $data_id = base64_decode($id);
        $data = $this->BeritaTable->find($data_id)->delete();
        $target = "upload/berita/".$data->is_cover;
        if($file_exists($target)){
            unlink($target);
        }
        $pesan = 'dihapus!';
        if($data){
            Session::flash('sukses', 'data berhasil '.$pesan);
        }else{
            Session::flash('gagal', 'data gagal '.$pesan);
        }
        return redirect('/home/berita');
    }
}
