@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">Pilih Soal</li>
</ul>
@endsection

@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Pilih Soal</h3>
        <ul class="panel-controls" style="margin-top: 2px;">
          <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
              <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
            	@php
            		$jumlahskor = 0;
            		foreach($data as $cc){
            			$jumlahskor += $cc->soalBankSoal->skor_soal;
            		}
            	@endphp
            	<p>[skor : {{ $jumlahskor }}]</p>
            	<br><br>
            		<table class="table table-bordered">
            		<thead>
            			<tr>
            				<th>No</th>
            				<th>Soal</th>
            				<th>Type Soal</th>
            				<th>Jenis Soal</th>
            				<th>Jumlah Jawaban</th>
            				<th>Skor</th>
                    <th>Lable</th>
            				<th></th>
            			</tr>
            		</thead>
            		<tbody>
            			@forelse($data as $key => $dat)
            			<tr>
            				<td>{{ $key + 1 }}</td>
            				<td><a href="{{ url('/home/soal/data/detail/soal/'.base64_encode($dat->soalBankSoal->id)) }}" target="_blank">Lihat Soal</a>
            				</td>
						    <td>
						      	@if($dat->soalBankSoal->type_soal == 0)
						      	TEXT
						      	@elseif($dat->soalBankSoal->type_soal == 1)
						      	TEXT - MEDIA
						      	@elseif($dat->soalBankSoal->type_soal == 2)
						      	MEDIA - TEXT
						      	@elseif($dat->soalBankSoal->type_soal == 3)
						      	FULL MEDIA
						      	@endif
						    </td>
						    <td>
						      	@if($dat->soalBankSoal->jenis_soal == 0)
						      	TEXT
						      	@elseif($dat->soalBankSoal->jenis_soal == 1)
						      	IMAGE
						      	@elseif($dat->soalBankSoal->jenis_soal == 2)
						      	AUDIO
						      	@elseif($dat->soalBankSoal->jenis_soal == 3)
						      	VIDEO
						      	@elseif($dat->soalBankSoal->jenis_soal == 4)
						      	IMAGE - TEXT
						      	@elseif($dat->soalBankSoal->jenis_soal == 5)
						      	AUDIO - TEXT
						      	@elseif($dat->soalBankSoal->jenis_soal == 6)
						      	VIDEO - TEXT
						      	@elseif($dat->soalBankSoal->jenis_soal == 7)
						      	IMAGE - IMAGE
						      	@elseif($dat->soalBankSoal->jenis_soal == 8)
						      	IMAGE - AUDIO
						      	@elseif($dat->soalBankSoal->jenis_soal == 9)
						      	IMAGE - VIDEO
						      	@elseif($dat->soalBankSoal->jenis_soal == 10)
						      	AUDIO - AUDIO
						      	@elseif($dat->soalBankSoal->jenis_soal == 11)
						      	AUDIO - IMAGE
						      	@elseif($dat->soalBankSoal->jenis_soal == 12)
						      	AUDIO - VIDEO
						      	@elseif($dat->soalBankSoal->jenis_soal == 13)
						      	VIDEO - VIDEO
						      	@elseif($dat->soalBankSoal->jenis_soal == 14)
						      	VIDEO - AUDIO
						      	@elseif($dat->soalBankSoal->jenis_soal == 15)
						      	VIDEO - IMAGE
						      	@endif
						    </td>
						    <td>{{ $dat->soalBankSoal->jlm_jawaban  }}  yang sudah ada : {{ @count($dat->soalBankSoal->bsJawaban) }}</td>
						    <td>{{ $dat->soalBankSoal->skor_soal }}</td>
                <td>{{ $dat->soalBankSoal->lable }}</td>
						    <td>
						    	<form action="{{ route('pilih-soal.destroy', base64_encode($dat->id)) }}" method="post">
						    		@csrf
						    		@method('delete')
						    		<button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-trash-o"></span>Remove</button>
						    	</form>
						    </td>
            			</tr>
            			@empty
            			<tr>
            				<td colspan="8"><center><strong>data belum ada!</strong></center></td>
            			</tr>
            			@endforelse
            		</tbody>
            	</table>
            	
            	<br><br>
            	
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection