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
            <div class="col-md-4">
              <form action="{{ url('home/pilih/soal/paket/'.$id) }}" method="get">
                <input type="text" name="q" class="form-control" placeholder="Enter Search Lable" required="required"><br>
              </form>
            </div>
            <div class="col-md-12">
            	[ yang dipilih : 0 ] <br>
            	<a href="{{ route('pilih-soal.show', base64_encode($datapaket->id)) }}" class="btn btn-default btn-sm">lihat</a>
            	<br><br>
            	<form method="post" action="{{ route('pilih-soal.store') }}">
            		@csrf
            		<input type="hidden" name="paket_id" value="{{ $datapaket->id }}">
            		<div class="form-group">
	                  <input type="submit" class="btn btn-default" value="Save" />
	                  <input type="reset" class="btn btn-default" value="Clear">
	                  <button onclick="self.history.back()" class="btn btn-primary">Back</button>
	                </div>
            		<table class="table table-bordered">
            		<thead>
            			<tr>
            				<th>No</th>
            				<th>[pilih]</th>
            				<th>Soal</th>
            				<th>Type Soal</th>
            				<th>Jenis Soal</th>
            				<th>Jumlah Jawaban</th> 
            				<th>Skor</th>
                    <th>Lable</th>
            			</tr>
            		</thead>
            		<tbody>
            			@forelse($data as $key => $dat)
            			<tr>
            				<td>{{ $key + 1 }}</td>
            				<td>
                      @if(@count($dat->bsJawaban) >= $dat->jlm_jawaban )
            					<center><input type="checkbox" name="checksoal[]" value="{{ base64_encode($dat->id) }}"></center>
                      @endif
            				</td>
            				<td><a href="{{ url('/home/soal/data/detail/soal/'.base64_encode($dat->id)) }}" target="_blank"
                      data-toggle="tooltip" data-placement="top" title="{!! $dat->lable  !!}" data-original-title="{!! $dat->lable  !!}"
                      >Lihat Soal</a></td>
						    <td>
						      	@if($dat->type_soal == 0)
						      	TEXT
						      	@elseif($dat->type_soal == 1)
						      	TEXT - MEDIA
						      	@elseif($dat->type_soal == 2)
						      	MEDIA - TEXT
						      	@elseif($dat->type_soal == 3)
						      	FULL MEDIA
						      	@endif
						    </td>
						    <td>
						      	@if($dat->jenis_soal == 0)
						      	TEXT
						      	@elseif($dat->jenis_soal == 1)
						      	IMAGE
						      	@elseif($dat->jenis_soal == 2)
						      	AUDIO
						      	@elseif($dat->jenis_soal == 3)
						      	VIDEO
						      	@elseif($dat->jenis_soal == 4)
						      	IMAGE - TEXT
						      	@elseif($dat->jenis_soal == 5)
						      	AUDIO - TEXT
						      	@elseif($dat->jenis_soal == 6)
						      	VIDEO - TEXT
						      	@elseif($dat->jenis_soal == 7)
						      	IMAGE - IMAGE
						      	@elseif($dat->jenis_soal == 8)
						      	IMAGE - AUDIO
						      	@elseif($dat->jenis_soal == 9)
						      	IMAGE - VIDEO
						      	@elseif($dat->jenis_soal == 10)
						      	AUDIO - AUDIO
						      	@elseif($dat->jenis_soal == 11)
						      	AUDIO - IMAGE
						      	@elseif($dat->jenis_soal == 12)
						      	AUDIO - VIDEO
						      	@elseif($dat->jenis_soal == 13)
						      	VIDEO - VIDEO
						      	@elseif($dat->jenis_soal == 14)
						      	VIDEO - AUDIO
						      	@elseif($dat->jenis_soal == 15)
						      	VIDEO - IMAGE
						      	@endif
						    </td>
						    <td>{{ $dat->jlm_jawaban  }}  yang sudah ada : {{ @count($dat->bsJawaban) }}</td>
						    <td>{{ $dat->skor_soal }}</td>
                <td>{{ $dat->lable }}</td>
            			</tr>
            			@empty
            			<tr>
            				<td colspan="7"><center><strong>data belum ada!</strong></center></td>
            			</tr>
            			@endforelse
            		</tbody>
            	</table>
            	<div class="form-group">
                  <input type="submit" class="btn btn-default" value="Save" />
                  <input type="reset" class="btn btn-default" value="Clear">
                  <button onclick="self.history.back()" class="btn btn-primary">Back</button>
                </div>
            	</form>
            	<br><br>
            	
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection