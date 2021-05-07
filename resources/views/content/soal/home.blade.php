@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li><a href="{{ url('home/soal') }}">Soal</a></li>
  <li><a href="{{ url('home/matpel') }}">Mata Pelajaran</a></li>
  <li class="active">Soal</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Soal</h3>
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
      	<div >
      		<a href="{{ route('name.media') }}" target="_blank" class="btn btn-default btn-sm">Name Media</a>
      		@if(@count($data) > 0)
      		<div class="dropdown pull-right">
      		  <a href="#" class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown">Jawaban <span class="caret"></span></a>
      		  <ul class="dropdown-menu">
			    <li><a href="#" data-toggle="modal" data-target="#import_text_jawaban">Import Jawaban</a></li>
			    <li><a href="#" data-toggle="modal" data-target="#import_media_jawaban">Import Media</a></li>
			  </ul>
      		</div>
      		@endif
      		<div class="dropdown pull-right">
      		  <a href="#" class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown">Full Media <span class="caret"></span></a>
      		  <ul class="dropdown-menu">
			    <li><a href="{{ url('/home/soal/form/full-media/'.$id) }}">Input Full Media</a></li>
			    <li><a href="#" data-toggle="modal" data-target="#import_full_media">Import Soal</a></li>
			  </ul>
      		</div>
      		<div class="dropdown pull-right">
      		  <a href="#" class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown">Media - Text <span class="caret"></span></a>
      		  <ul class="dropdown-menu">
			    <li><a href="{{ url('/home/soal/form/media-text/'.$id) }}">Input Media - Text</a></li>
			    <li><a href="#" data-toggle="modal" data-target="#import_media_text">Import Soal</a></li>
			  </ul>
      		</div>
      		<div class="dropdown pull-right">
      		  <a href="#" class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown">Text - Media <span class="caret"></span></a>
      		  <ul class="dropdown-menu">
			    <li><a href="{{ url('/home/soal/form/text-media/'.$id) }}">Input Text - Media </a></li>
			    <li><a href="#" data-toggle="modal" data-target="#import_text_media">Import Soal</a></li>
			    
			  </ul>
      		</div>
      		<div class="dropdown pull-right">
      		  <a href="#" class="btn btn-default btn-sm dropdown-toggle " type="button" data-toggle="dropdown">Text <span class="caret"></span></a>
      		  <ul class="dropdown-menu">
			    <li><a href="{{ url('/home/soal/form/text/'.$id) }}">Input Text</a></li>
			    <li><a href="#" data-toggle="modal" data-target="#import_text">Import Soal</a></li>
			  </ul>
      		</div>
      		<div class="modal" id="import_full_media" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" style="margin-top: 7px"><span aria-hidden="true" >×</span><span class="sr-only">Close</span></button>
	                        <h4 class="modal-title" id="defModalHead">Import Soal Full Media</h4>
	                    </div>
	                    <div class="modal-body">
	                        <div>
	                        	<form action="{{ route('import.soal', ['fullmedia', $id]) }}" method="post" enctype="multipart/form-data">
	                        		@csrf
	                        		<label for="Jenis_Media">Jenis Soal dan Jawaban <span style="color:red">*</span></label>
		            				<select name="jenis_soal" id="Jenis_Media" required="required" class="form-control">
		            					<option value="">--pilih--</option>
		            					<option value="7">Image - Image</option> 
		            					<!-- <option value="8">Image - Audio</option> 
		            					<option value="9">Image - Video</option> 
		            					<option value="10">Audio - Audio</option> -->
		            					<option value="11">Audio - Image</option> 
		            					<!--<option value="12">Audio - Video</option> 
		            					<option value="13">Video - Video</option> 
		            					<option value="14">Video - Audio</option>  -->
		            					<option value="15">Video - Image</option> 
		            				</select>
	                        		<label>Pilih File dengan format CSV, XLS, XLSX : </label>
	                        		<input type="file" name="file" required="required"><br>
	                        		Download <a href="{{ asset('example.xlsx') }}" download="example.xlsx">Example</a>
	                        		<br>
	                        		<input type="submit" class="btn btn-default btn-sm" value="Save">

	                        	</form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
      		<div class="modal" id="import_media_text" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" style="margin-top: 7px"><span aria-hidden="true" >×</span><span class="sr-only">Close</span></button>
	                        <h4 class="modal-title" id="defModalHead">Import Soal Media - Text</h4>
	                    </div>
	                    <div class="modal-body">
	                        <div>
	                        	<form action="{{ route('import.soal', ['mediatext', $id]) }}" method="post" enctype="multipart/form-data">
	                        		@csrf
	                        		<label for="Jenis_Media">Jenis Soal <span style="color:red">*</span></label>
		            				<select name="jenis_soal" id="Jenis_Media" required="required" class="form-control">
		            					<option value="">--pilih--</option>
		            					<option value="4">Image</option> <!-- id=4 image-text -->
		            					<option value="5">Audio</option> <!-- id=5 audio-text -->
		            					<!-- <option value="6">Video</option> <!-- id=6 video-text --> -->
		            				</select>
	                        		<label>Pilih File dengan format CSV, XLS, XLSX : </label>
	                        		<input type="file" name="file" required="required"><br>
	                        		Download <a href="{{ asset('example.xlsx') }}" download="example.xlsx">Example</a>
	                        		<br>
	                        		<input type="submit" class="btn btn-default btn-sm" value="Save">

	                        	</form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
      		<div class="modal" id="import_text_media" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" style="margin-top: 7px"><span aria-hidden="true" >×</span><span class="sr-only">Close</span></button>
	                        <h4 class="modal-title" id="defModalHead">Import Soal Text - Media</h4>
	                    </div>
	                    <div class="modal-body">
	                        <div>
	                        	<form action="{{ route('import.soal', ['textmedia', $id]) }}" method="post" enctype="multipart/form-data">
	                        		@csrf
	                        		<label for="Jenis_Media">Jenis Jawaban <span style="color:red">*</span></label>
		            				<select name="jenis_soal" id="Jenis_Media" required="required" class="form-control">
		            					<option value="">--pilih--</option>
		            					<option value="1">Image</option> <!-- id=1 text-image -->
		            					<option value="2">Audio</option> <!-- id=2 text-audio -->
		            					<!-- <option value="3">Video</option> <!-- id=3 text-video --> -->
		            				</select>
	                        		<label>Pilih File dengan format CSV, XLS, XLSX : </label>
	                        		<input type="file" name="file" required="required"><br>
	                        		Download <a href="{{ asset('example.xlsx') }}" download="'example.xlsx">Example</a>
	                        		<br>
	                        		<input type="submit" class="btn btn-default btn-sm" value="Save">

	                        	</form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
      		<div class="modal" id="import_text" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" style="margin-top: 7px"><span aria-hidden="true" >×</span><span class="sr-only">Close</span></button>
	                        <h4 class="modal-title" id="defModalHead">Import Soal Text</h4>
	                    </div>
	                    <div class="modal-body">
	                        <div>
	                        	<form action="{{ route('import.soal', ['text', $id]) }}" method="post" enctype="multipart/form-data">
	                        		@csrf
	                        		<input type="hidden" name="jenis_soal" value="0">
	                        		<label>Pilih File dengan format CSV, XLS, XLSX : </label>
	                        		<input type="file" name="file" required="required"><br>
	                        		Download <a href="{{ asset('example.xlsx') }}" download="example.xlsx">Example</a>
	                        		<br>
	                        		<input type="submit" class="btn btn-default btn-sm" value="Save">

	                        	</form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="modal" id="import_text_jawaban" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" style="margin-top: 7px"><span aria-hidden="true" >×</span><span class="sr-only">Close</span></button>
	                        <h4 class="modal-title" id="defModalHead">Import Jawaban Text</h4>
	                    </div>
	                    <div class="modal-body">
	                        <div>
	                        	<form action="{{ route('import.jawaban.all') }}" method="post" enctype="multipart/form-data">
	                        		@csrf
	                        		<label>Pilih File dengan format CSV, XLS, XLSX : </label><br>
	                        		<label>Perhatikan <b>bsoal_id</b> yang didapatkan di ID Soal pada table soal</label>
	                        		<input type="file" name="file" required="required"><br>
	                        		Download <a href="{{ asset('example-jawaban-all.xlsx') }}" download="example-jawaban-all.xlsx">Example</a>
	                        		<br>
	                        		<input type="submit" class="btn btn-default btn-sm" value="Save">

	                        	</form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="modal" id="import_media_jawaban" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
	            <div class="modal-dialog">
	                <div class="modal-content">
	                    <div class="modal-header">
	                        <button type="button" class="close" data-dismiss="modal" style="margin-top: 7px"><span aria-hidden="true" >×</span><span class="sr-only">Close</span></button>
	                        <h4 class="modal-title" id="defModalHead">Import Jawaban Media</h4>
	                    </div>
	                    <div class="modal-body">
	                        <div>
	                        	<form action="{{ route('import.media') }}" method="post" enctype="multipart/form-data">
	                        		@csrf
	                        		<label>Pilih File dengan format CSV, XLS, XLSX : </label><br>
	                        		<label>Perhatikan <b>bsoal_id</b> yang didapatkan di ID Soal pada table soal dan juga nama media harus sama dengan nama dari jawaban yang telah dimport terakhir</label>
	                        		<input type="file" name="file[]" multiple="multiple" required="required"><br>
	                        		<input type="submit" class="btn btn-default btn-sm" value="Save">

	                        	</form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
      		<br><br>
      		 
  </div>
      	</div>
          <div class="row">
          	<div class="col-md-4">
          		<form action="{{ url('home/soal/data/soal/'.$id) }}" method="get">
          			<input type="text" name="q" class="form-control" placeholder="Enter Search Lable" required="required"><br>
          		</form>
          	</div>
            <div class="col-md-12">
            	{!! $data->links() !!}
              <table class="table table-bordered">
				  <thead>
				    <tr >
				      <th>NO</th>
				      <th>ID Soal</th>
				      <th>Soal</th>
				      <th>Keterangan</th>
				      <th>Label</th>
				      <th>Jenis Soal</th>
				      <th>Jumlah Jawaban</th>
				      <th>Skor Soal</th>
				      <th></th>
				    </tr>
				  </thead>
				  <tbody>
				  	@forelse($data as $key => $dat)
				    <tr >
				      <td>{{ $key + 1  }}</td>
				      <td>
				      	{{ $dat->id }}
				      </td>
				      <td><a href="{{ url('/home/soal/data/detail/soal/'.base64_encode($dat->id)) }}">Lihat Soal</a></td>
				      <td><a href="{{ url('/home/soal/data/detail/keterangan/'.base64_encode($dat->id)) }}">Lihat Keterangan</a></td>
				      <td>
				      	{{ $dat->lable }}
				      </td>
				      <td>
				      	@if($dat->jenis_soal == 0)
				      	TEXT-TEXT
				      	@elseif($dat->jenis_soal == 1)
				      	TEXT-IMAGE
				      	@elseif($dat->jenis_soal == 2)
				      	TEXT-AUDIO
				      	@elseif($dat->jenis_soal == 3)
				      	TEXT-VIDEO
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
				      <td @if(@count($dat->bsJawaban) < $dat->jlm_jawaban) style="background:red" @endif>{{ $dat->jlm_jawaban  }}  yang sudah ada : {{ @count($dat->bsJawaban) }}</td>
				      <td>{{ $dat->skor_soal }}</td>
				      <td>
				      	<a href="{{ url('/home/soal/jawaban/data/'.base64_encode($dat->id)) }}" class="btn btn-default btn-sm">Isi Jawaban</a>
				      </td>
				    </tr>
				    @empty
				    <tr>
				    	<td colspan="8">
				    		<center><b>Data Kosong</b></center>
				    	</td>
				    </tr>
				    @endforelse
				  </tbody>
				</table>
				{!! $data->links() !!}
            </div>
            
          </div>
      </div>
    </div>
  </div>
</div>
@endsection