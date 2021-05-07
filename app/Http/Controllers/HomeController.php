<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tingkat;
use App\BankSoal;
use App\Matpel;
use App\Jawaban;
use App\Kelas;
use App\Periode;
use App\Ujian;
use App\Paket;
use App\Berita;
use App\Pengumuman;
use App\HistoryLogin;
use App\HistoryUjian;
use App\WaktuModel;
use App\Peserta;
use App\LaporanHamaModel;
use App\Soal;
use Response;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $TingkatTable;
    protected $BankSoalTable;
    protected $MatpelTable;
    protected $JawabanTable;
    protected $KelasTable;
    protected $PeriodeTable;
    protected $UjianTable;
    protected $PaketTable;
    protected $SoalTable;
    protected $HistoryLoginTable;
    protected $HistoryUjianTable;
    protected $PesertaTable;
    protected $WaktuTable;
    protected $LaporanHamaTable;

    public function __construct()
    {
        $this->middleware('auth');
        $this->TingkatTable = new Tingkat();
        $this->BankSoalTable = new BankSoal();
        $this->MatpelTable = new Matpel();
        $this->JawabanTable = new Jawaban();
        $this->KelasTable = new Kelas();
        $this->PeriodeTable = new Periode();
        $this->UjianTable = new Ujian();
        $this->PaketTable = new Paket();
        $this->SoalTable = new Soal();
        $this->HistoryLoginTable = new HistoryLogin();
        $this->HistoryUjianTable = new HistoryUjian();
        $this->PesertaTable = new Peserta();
        $this->WaktuTable = new WaktuModel();
        $this->LaporanHamaTable = new LaporanHamaModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $r)
    {
        $active = "home";
        $loginHariIni = $this->HistoryLoginTable
        ->where("created_at", "LIKE", "%".date("Y-m")."%")
        ->get();
        $registerBulanIni = $this->PesertaTable
        ->where("created_at", "LIKE","%".date("Y-m")."%")
        ->get();
        $historyUjian = $this->HistoryUjianTable
        ->where("created_at", "Like", "%".date("Y-m")."%")
        ->get();

        $hama = $this->LaporanHamaTable
        ->where("created_at", "LIKE", "%".date("Y-m")."%")
        ->get();

        $soal = $this->BankSoalTable->all();
        $ujian = $this->HistoryUjianTable->all();
        $akun = $this->PesertaTable->all();

        $data = [];
        if(!empty($r->q)){
             $waktu = $this->WaktuTable->where("tanggal", "LIKE", "%".$r->q."%")->orderBy("tanggal", "ASC")->get();
        }else{
            if(@count($r->btnchartbulan) > 0){
                $tanggal = date('Y-m-d', strtotime('- 1 months',strtotime(date('Y-m-d'))));
            }elseif(@count($r->btnchart3bulan) > 0){
                $tanggal = date('Y-m-d', strtotime('- 3 months',strtotime(date('Y-m-d'))));
            }else{
                $tanggal = date('Y-m-d', strtotime('- 1 weeks',strtotime(date('Y-m-d'))));
            }
             $waktu = $this->WaktuTable
             ->whereBetween('tanggal', [$tanggal, date("Y-m-d")])
             ->orderBy("tanggal", "ASC")
             ->get();
         }
         // $aa = [];
         // for ($i=0; $i <= 1439 ; $i++) { 
         //      $aa[] = date('Y-m-d H:i:s', strtotime('+ '. $i .' Minutes',strtotime(date('Y-m-d'))));
         // }
         // return $aa;
         

        foreach ($waktu as $key => $ujian1) {
            $data[] = $ujian1;
            $data[$key]->dateformat = date("d-F-Y", strtotime($ujian1->tanggal));
            $data[$key]->vujian = $this->HistoryUjianTable->where("created_at", "LIKE", "%".$ujian1->tanggal."%")->count();
            $data[$key]->vlogin = $this->HistoryLoginTable->where("created_at", "LIKE", "%".$ujian1->tanggal."%")->count();
            $data[$key]->vregister = $this->PesertaTable->where("created_at", "LIKE", "%".$ujian1->tanggal."%")->count();
        }
        // return $data;
        return view('content.home', compact(
            "active", 
            "loginHariIni", 
            "registerBulanIni",
            "historyUjian",
            "data",
            'soal',
            'ujian',
            'akun',
            'hama'
        ));
    }

    public function getHama(){
        $active = "Hama";
        $data = [];
        $hama = $this->LaporanHamaTable->orderByDesc("created_at")->paginate(50);
        // $data->hama = $data->hamaPeserta;
        foreach ($hama as $key => $v) {
            $data[$key] = $v;
            $data[$key]->dateformat = date("d-F-Y H:i:s", strtotime($v->created_at));
            $data[$key]->vpeserta = $this->PesertaTable->find($v->peserta_id);
        }

        return view('content.hama.index',compact('data', 'active'));

    }
    public function showHama($id){
        $active = "Show Hama";
        $data_id = base64_decode($id);
        $data = [];
        $data = $this->LaporanHamaTable->find($data_id);
        $data->peserta = $this->PesertaTable->find($data->peserta_id);

        return view('content.hama.show',compact('data', 'active'));
    }

    public function datatingkat()
    {
        return $this->TingkatTable->orderByDesc('id')->get();
    }

    public function soaltingkat(){
        $data = $this->datatingkat();
        $active = "soal";
        return view('content.soal.index',compact('data', 'active'));
    }

    public function soalmatpel($id){
        $data_id = base64_decode($id);
        $data = $this->MatpelTable->where('kelas_id', $data_id)->get();
        // return $data;
        $active = "soal";
        return view('content.soal.matpel', compact('data', 'active'));
    }

    public function soaldata(Request $r, $id){
        $data_id = base64_decode($id); 
        if(!empty($r->q)){
            $data = $this->BankSoalTable->where('lable', "LIKE", "%".$r->q."%")->paginate(35);
        }else{
            $data = $this->BankSoalTable->where('matpel_id', $data_id)->orderByDesc('id')->paginate(35);
        }
        $active = "soal";
        return view('content.soal.home', compact('data', 'id', 'active'));
    }

    public function formsoal($kondisi, $id){
        $active = "soal";
        return view('content.soal.form', compact('id', 'kondisi', 'active'));
    } 

    public function jawabandata($id){
        $data_id = base64_decode($id);
        $datafind = $this->BankSoalTable->find($data_id);
        $data = $this->JawabanTable->where('bsoal_id',$data_id)->orderBy('objectif', 'ASC')->get();
        $active = "soal";
        return view('content.soal.datajawaban', compact('data', 'datafind', 'id', 'active'));
    }

    public function getDetailSoalJawaban($kondisi, $id){
        $data_id = base64_decode($id);
        $datafind = $this->BankSoalTable->find($data_id);
        $active = "soal";
        return view('content.soal.soaljawaban', compact('datafind', 'kondisi', 'active'));
    }

    // public function periode(){
    //     return view('')
    // }

    public function getUjian(){
        $matpel = $this->TingkatTable->get();
        $periode = $this->PeriodeTable->where('status_periode', "1")->get();
        $data = $this->UjianTable->orderByDesc('id')->paginate(14);
        // return $data;
        $active = "ujian";
        return view('content.ujian.home', compact('matpel', 'periode', 'data', 'active'));
    }

    public function getPaket($id){ 
        $data_id = base64_decode($id);
        $data = $this->PaketTable->where('ujian_id', $data_id)->orderBy('title', 'ASC')->get();
        // $data = [];
        // $paket = $this->PaketTable->where('ujian_id', $data_id)->orderBy('title', 'ASC')->get();
        // foreach ($paket as $key => $v) {
        //     $data[$key] = $v;
        //     $ceksoal = $this->SoalTable->where('paket_id', $v->id)->count();
        //     $data[$key]->ceksoal = $ceksoal;
        // }

        // return $data;
        $active = "ujian";
        $datalast = $this->PaketTable->where('ujian_id', $data_id)->orderByDesc('title')->first();
        return view('content.paket.home', compact('data', 'datalast', 'id', 'active'));
    }
    public function getSoalPaket(Request $r, $id){ 
        $data_id = base64_decode($id);
        $datapaket = $this->PaketTable->find($data_id);
        $datapaketUjian = $datapaket->paketUjian; // matpel_id
        // return $datapaket;

        $data = [];

        if(!empty($r->q)){
            $banksoal = $this->BankSoalTable->where('matpel_id', $datapaketUjian->matpel_id)->where("lable", "LIKE", "%".$r->q."%")->get();
        }else{
            $banksoal = $this->BankSoalTable->where('matpel_id', $datapaketUjian->matpel_id)->orderBy("id", "ASC")->get();
        }
        foreach($banksoal as $key => $v){
            $vcek =  $this->SoalTable->where('bsoal_id', $v->id)->get();
            if(@count($vcek) < 1){
                $data[$key] = $v;
            }
        }
        $active = "ujian";
        return view('content.paket.pilihsoal', compact('data', 'datapaket', 'datapaketUjian', 'active', 'id'));
        
    }
}
