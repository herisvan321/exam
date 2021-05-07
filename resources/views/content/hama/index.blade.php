@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">Hama</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Hama</h3>
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
				      <th>Email</th>
				      <th >Nama</th>
				      <th>Tanggal</th>
				      <th ></th>
				    </tr>
				  </thead>
				  <tbody>
				    @forelse($data as $key => $dat)
				    <tr>
				      <td>{{ $key + 1 }}</td>
				      <td>{{ $dat->vpeserta->email }}</td>
				      <td>{{ $dat->vpeserta->nama_depan." ".$dat->vpeserta->nama_belakang }}</td>
				      <td>{{ $dat->dateformat }}</td>
				      <td>
				      	<a href="{{ url('/home/hama/'.base64_encode($dat->id)) }}" class="btn btn-default">Show</a>
				      </td>
				    </tr>
				    @empty
				    <tr>
				      <td colspan="4"><center>Data Tidak ada!</center></td>
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