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
        <h3 class="panel-title">Tingkat</h3>
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
            <div class="col-md-9">
            	@include('content.ujian.table')
            </div>
            <div class="col-md-3">
              <form method="post" action="{{ route('data-ujian.update', $id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                	<label for="Mata Pelajaran">Mata Pelajaran</label>
                	<select name="matpel_id" class="form-control" required="required">
                		<option value="">[pilih]</option>
                    @foreach($matpel as $mat)
                    <option disabled="disabled" style="background: #dfdfdf">{{ $mat->title }}</option>
                      @foreach($mat->tingkatKelas as $tingkelas)
                        <option disabled="disabled" style="background: #dfd">---| {{ $tingkelas->title }}</option>
                        @foreach($tingkelas->kelasMatpel as $kelmatpel)
                          <option value="{{ $kelmatpel->id }}" {{ $datafind->matpel_id == $kelmatpel->id ? "selected=='selected'" : '' }}>{{ $kelmatpel->title }}</option>
                        @endforeach
                      @endforeach
                    @endforeach
                	</select>
                </div>
                <div class="form-group">
                	<label for="Periode">Periode</label>
                	<select name="periode_id" class="form-control" required="required">
                		<option value="">[pilih]</option>
                		@foreach($periode as $period)
                			<option value="{{ $period->id }}" {{ $datafind->periode_id == $period->id ? "selected=='selected'" : '' }}>{{ $period->title }}</option>
                		@endforeach
                	</select>
                </div>
                <div class="form-group">
                	<label for="title">Title</label>
                	<input type="text" name="title" id="title" placeholder="Enter title ..." class="form-control" value="{{ $datafind->title }}" />
                </div>
                <div class="form-group">
                	<label for="jlm_soal">Jumlah Soal</label>
                	<input type="number" name="jlm_soal" id="jlm_soal" placeholder="Enter Jumlah Soal ..." class="form-control" value="{{ $datafind->jlm_soal }}" />
                </div>
                <div class="form-group">
                	<label for="description">Description</label>
                	<textarea name="description" id="description" class="form-control" required="required">{{ $datafind->description }}</textarea>
                </div>
                 <div class="form-group">
                	<label for="status_ujian">Status Ujian</label>
                	<select name="status_ujian" class="form-control" required="required">
                		<option value="">[pilih]</option>
                		<option value="0" {{ $datafind->status_ujian == "0" ? "selected=='selected'" : '' }}>Non Active</option>
                		<option value="1" {{ $datafind->status_ujian == "1" ? "selected=='selected'" : '' }}>Active</option>
                	</select>
                </div>
                <div class="form-group">
                	<label for="alokasi_waktu">Alokasi Waktu</label>
                	<select name="alokasi_waktu" class="form-control" required="required">
                		<option value="">[pilih]</option>
                		<option value="30" {{ $datafind->alokasi_waktu == "30" ? "selected=='selected'" : '' }}>30 Menit</option>
                		<option value="45" {{ $datafind->alokasi_waktu == "45" ? "selected=='selected'" : '' }}>45 Menit</option>
                		<option value="60" {{ $datafind->alokasi_waktu == "60" ? "selected=='selected'" : '' }}>60 Menit</option>
                		<option value="90" {{ $datafind->alokasi_waktu == "90" ? "selected=='selected'" : '' }}>90 Menit</option>
                		<option value="120" {{ $datafind->alokasi_waktu == "120" ? "selected=='selected'" : '' }}>120 Menit</option>
                	</select>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-default" value="Update" />
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