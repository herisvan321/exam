@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li><a href="{{ url('home/soal') }}">Soal</a></li>
  <li class="active">Jawaban</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Jawaban</h3>
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
            	@include('content.soal.contohurl')
            	<form action="{{ route('jawaban.update', $id) }}" method="post">
            		@csrf
            		@method('put')
            		<div class="form-group">
            			<label for="Objectif">Objectif</label>
            			<input type="text" name="objectif" id="Objectif" placeholder="Enter Objectif A/B/C/D/E..." class="form-control" required="required" value="{{ $data->objectif }}" />
            		</div>
            		<div class="form-group">
            			<label for="lable">Content</label>
            			@if($datafind->jenis_soal == 0 || $datafind->jenis_soal == 4 || $datafind->jenis_soal == 5 || $datafind->jenis_soal == 6)
				      	<textarea class="form-control" name="content" placeholder="Enter Jawaban Text" required="required">{{ $data->content }}</textarea>
				      	@elseif($datafind->jenis_soal == 1 || $datafind->jenis_soal == 7 || $datafind->jenis_soal == 11 || $datafind->jenis_soal == 15)
				      	<input type="url" class="form-control" name="content" placeholder="Enter Jawaban Image" required="required" value="{{ $data->content }}">
				      	@elseif($datafind->jenis_soal == 2 || $datafind->jenis_soal == 8 || $datafind->jenis_soal == 10 || $datafind->jenis_soal == 14)
				      	<input type="url" class="form-control" name="content" placeholder="Enter Jawaban Audio" required="required" value="{{ $data->content }}">
				      	@elseif($datafind->jenis_soal == 3 || $datafind->jenis_soal == 9 || $datafind->jenis_soal == 12 || $datafind->jenis_soal == 13)
				      	<input type="url" class="form-control" name="content" placeholder="Enter Jawaban Video" required="required" value="{{ $data->content }}">
				      	@endif
            		</div>
            		<div class="form-group">
            			<input type="submit" value="Update" class="btn btn-default">
            			<input type="reset" value="Clear" class="btn btn-default">
            			<a href="{{ url('/home/soal/jawaban/data/'.base64_encode($datafind->id)) }}" class="btn btn-primary">Back</a>
            		</div>
            	</form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection