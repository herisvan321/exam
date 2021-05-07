<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\HistoryLogin;

class HistoryLoginController extends Controller
{
    protected $HistoryLoginTable;

    function __construct(){
        $this->middleware('auth');
    	$this->HistoryLoginTable = new HistoryLogin();
    }

    public function index()
    {
        $data = $this->HistoryLoginTable->orderByDesc('id')->pagination(50);
        return $data;
    }

    public function show($id)
    {
        $data_id = $id;
        $data = $this->HistoryLoginTable->find($data_id);
        return $data;
    }
}
