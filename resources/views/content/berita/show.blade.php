@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">Berita</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Berita</h3>
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
              <button onclick="self.history.back()" class="btn btn-primary">Back</button>
              <br><h5>{{ $data->status_berita }}</h5>
              <h1>{{ $data->title }}</h1>
              <img src="{{ asset('/upload/berita/'.$data->is_cover) }}" style="width: 50%"><br><br>
              <p>{{ $data->description }}</p>
              <hr>
              <p>{!! $data->content !!}</p>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection