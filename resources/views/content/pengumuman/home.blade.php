@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">Pengumuman</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Pengumuman</h3>
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
              <form method="post" action="{{ route('pengumuman.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="Tingkat">Tingkat</label>
                  <select class="form-control" required="required" name="tingkat_id">
                    <option value="">[pilih]</option>
                    <option value="0">Semua</option>
                    @foreach($tingkat as $tingkats)
                    <option value="{{ $tingkats->id }}">{{ $tingkats->title }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="Title">Title</label>
                  <input type="text" name="title" id="Title" placeholder="Enter Title ..." class="form-control" required="required" />
                </div>
                <div class="form-group">
                  <label for="Content">Content</label>
                  <textarea name="content" id="ckeditor" class="ckeditor" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-default" value="Save" />
                  <input type="reset" class="btn btn-default" value="Clear">
                  <button onclick="self.history.back()" class="btn btn-primary">Back</button>
                </div>
              </form>
            </div>
            <div class="col-md-12">
             @include('content.pengumuman.table')
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection