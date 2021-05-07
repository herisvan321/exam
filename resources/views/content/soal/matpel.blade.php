@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li><a href="{{ url('home/soal') }}">Soal</a></li>
  <li class="active">Mata Pelajaran</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Mata Pelajaran</h3>
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
              <table class="table table-bordered datatable">
				  <thead>
				    <tr >
				      <th>NO</th>
				      <th>Title</th>
				      <th>Kelas</th>
				      <th>Tingkat</th>
				      <th>Jumlah Soal</th>
				      <th >Status</th>
				      <th></th>
				    </tr>
				  </thead>
				  <tbody>
				    @forelse($data as $key => $dat)
				    <tr>
				      <td>{{ $key + 1 }}</td>
				      <td>{{ $dat->title }}</td>
				      <td>{{ $dat->matpelKelas->title }}</td>
				      <td>{{ $dat->matpelKelas->kelasTingkat->title }}</td>
				      <td>{{ @count($dat->matpelBankSoal) }}</td>
				      <td>
				        @if($dat->status_matpel == 0)
				        <a href="#" class="btn btn-warning btn-sm">Non Active</a>
				        @else
				        <a href="#" class="btn btn-default btn-sm">Active</a>
				        @endif
				      </td>

				      <td>
				        <a href="{{ url('/home/soal/data/soal/'.base64_encode($dat->id)) }}" class="btn btn-default btn-sm">Pilih</a>
				  
				      </td>
				    </tr>
				    @empty
				    <tr>
				      <td colspan="7"><center>Data Tidak ada!</center></td>
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