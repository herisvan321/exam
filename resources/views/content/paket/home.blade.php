@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">Ujian</li>
</ul>
@endsection

@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Ujian</h3>
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
            <div class="col-md-8">
            	@include('content.paket.table')
            </div>
            <div class="col-md-4">
              <form method="post" action="{{ route('paket-ujian.store') }}">
                @csrf
                <div class="form-group">
                	@php
                	if(@count($datalast) > 0){
                		$pecah = explode(" ", $datalast->title);
	                	$ambil = $pecah[1] + 1;
	                	$outtitle = "Paket " . $ambil;
               		}
                	@endphp
                	<label for="title">Title</label>
                	<input type="text" name="title" id="title" placeholder="Enter title ..." class="form-control" value="{{ @count($datalast) > 0 ? $outtitle : 'Paket 1'}}" />
                </div>
                 <div class="form-group">
                 	<input type="hidden" name="ujian_id" value="{{ $id }}">
                	<label for="status_paket">Status Ujian</label>
                	<select name="status_paket" class="form-control" required="required">
                		<option value="">[pilih]</option>
                		<option value="0">Non Active</option>
                		<option value="1">Active</option>
                	</select>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-default" value="Save" />
                  <input type="reset" class="btn btn-default" value="Clear">
                  <button onclick="self.history.back()" class="btn btn-primary">Back</button>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection