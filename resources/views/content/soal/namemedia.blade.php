@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">Name Media</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Media</h3>
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
            <div class="col-md-3">
            	<form action="" method="get">
            		<label>Media</label>
            		<select class="form-control" name="media" required="required">
            			<option value="">[pilih]</option>
            			<option value="0">SOAL</option>
            			<option value="1">JAWABAN</option>
            		</select>
            		<label>Jumlah Media</label>
            		<input type="number" name="jlmmedia" class="form-control" required="required">
            		<br>
            		<input type="submit" value="Proses" class="btn btn-info" name="submit">
            	</form>
            </div>
            <div class="col-md-9">
            	<ol type="1">
            		@for($i = 1; $i <= $jlmmedia; $i++)
            			<li>
            				<b>
            				@if($media == 0)
            				@php($aa = 'SOAL')
            				@elseif($media == 1)
            				@php($aa = 'JAWABAN')
            				@endif
            				{{ $aa.'-'.date('YmdHis').'-'.date('His') * $i * 3 .'-'. $i }}
            				</b>
            			</li>
            		@endfor
            	</ol>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection