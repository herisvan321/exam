<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Peserta;
use Response;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $PesertaTable;

    function __construct(){
        $this->middleware('auth');
        $this->PesertaTable = new Peserta();
    }
    public function index()
    {
        $data = $this->PesertaTable->orderByDesc('id')->pagination(50);
        return $data;
    }

    public function show($id)
    {
        $data_id = $id;
        $data = $this->PesertaTable->find($data_id);
        return $data;
    }

}
