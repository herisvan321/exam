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
              <h3>{{ $datafind->lable }}</h3>
            	@if(@count($data) < $datafind->jlm_jawaban)
            	<form action="{{ route('jawaban.store') }}" method="post" enctype="multipart/form-data">
            		@csrf
            		<input type="hidden" name="bsoal_id" value="{{ $id }}">
            		<div class="form-group">
            			<label for="Objectif">Objectif</label>
            			<input type="text" name="objectif" id="Objectif" placeholder="Enter Objectif A/B/C/D/E..." class="form-control" required="required" />
            		</div>
            		<div class="form-group">
            		<label for="lable">Content</label>
            		@if($datafind->jenis_soal == 0 || $datafind->jenis_soal == 4 || $datafind->jenis_soal == 5 || $datafind->jenis_soal == 6)
				      	<textarea class="form-control" name="content" placeholder="Enter Jawaban Text" required="required"></textarea>
				      	@elseif($datafind->jenis_soal == 1 || $datafind->jenis_soal == 7 || $datafind->jenis_soal == 11 || $datafind->jenis_soal == 15)
				      	<input type="file" class="form-control" name="content" placeholder="Enter Jawaban Image" required="required" accept="image/*">
				      	@elseif($datafind->jenis_soal == 2 || $datafind->jenis_soal == 8 || $datafind->jenis_soal == 10 || $datafind->jenis_soal == 14)
				      	<input type="file" class="form-control" name="content" placeholder="Enter Jawaban Audio" required="required" accept="audio/*">
				      	@elseif($datafind->jenis_soal == 3 || $datafind->jenis_soal == 9 || $datafind->jenis_soal == 12 || $datafind->jenis_soal == 13)
				      	<input type="file" class="form-control" name="content" placeholder="Enter Jawaban Video" required="required" accept="video/*">
				      	@endif
                <input type="hidden" name="jenis_soal" value="{{ $datafind->jenis_soal }}">
            		</div>
            		<div class="form-group">
            			<input type="submit" value="Save" class="btn btn-default">
            			<input type="reset" value="Clear" class="btn btn-default">
                  @if($datafind->jenis_soal == 0 || $datafind->jenis_soal == 4 || $datafind->jenis_soal == 5 || $datafind->jenis_soal == 6)
                  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#import_text">Import</a>
                  @endif
            			<a href="{{ url('/home/soal/data/soal/'.base64_encode($datafind->matpel_id)) }}" class="btn btn-primary">Back</a>
            		</div>
            	</form>
              <div class="modal" id="import_text" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true" style="display: none;">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" style="margin-top: 7px"><span aria-hidden="true" >×</span><span class="sr-only">Close</span></button>
                          <h4 class="modal-title" id="defModalHead">Import Jawaban Text</h4>
                      </div>
                      <div class="modal-body">
                          <div>
                            <form action="{{ route('import.jawaban.text', $id) }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <label>Pilih File dengan format CSV, XLS, XLSX : </label>
                              <input type="file" name="file" required="required"><br>
                              Download <a href="{{ asset('example-jawaban.xlsx') }}" download="{{ asset('example-jawaban.xlsx') }}">Example</a>
                              <br>
                              <input type="submit" class="btn btn-default btn-sm" value="Save">

                            </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          @else
          <a href="{{ url('/home/soal/data/soal/'.base64_encode($datafind->matpel_id)) }}" class="btn btn-primary">Back</a>
          @endif
            </div>
            <div class="col-md-12">
            	<hr>
            	<table class="table">
            		<thead>
            			<tr>
            				<th>No</th>
            				<th>Objectif</th>
            				<th>Jawaban</th>
            				<th></th>
            			</tr>
            		</thead>
            		<tbody>
            			@forelse($data as $key => $dat)
            			<tr>
            				<td>{{ $key + 1 }}</td>
            				<td>{{ $dat->objectif }}</td>
            				<td>{!! $dat->content !!}</td>
            				<td>
            					<a href="{{ route('jawaban.show', base64_encode($dat->id)) }}" class="btn btn-danger btn-sm">Remove</a>
            				</td>
            			</tr>
            			@empty
            			<tr>
            				<td colspan="4"><center><strong>Data Kosong!</strong></center></td>
            			</tr>
            			@endforelse
            		</tbody>
            	</table>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection