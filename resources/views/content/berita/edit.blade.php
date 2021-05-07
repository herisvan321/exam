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
            <div class="col-md-8">
              <form method="post" action="{{ route('berita.update', base64_encode($datafind->id)) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                  <label for="Title">Title</label>
                  <input type="text" name="title" id="Title" placeholder="Enter Title ..." class="form-control" required="required" value="{{ $datafind->title }}" />
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" class="form-control" placeholder="Enter Description" required="required">{{ $datafind->description }}</textarea>
                </div>
                <div class="form-group">
                  <label for="Content">Content</label>
                  <textarea name="content" id="ckeditor" class="ckeditor" class="form-control">{{ $datafind->content }}</textarea>
                </div>
                <div class="form-group">
                  <img src="{{ asset('/upload/berita/'.$datafind->is_cover) }}" style="width: 150px"> <br><br>
                  <label for="Cover">Cover</label>
                  <input type="file" name="is_cover" id="Cover" placeholder="Enter Cover ..." class="form-control"  />
                </div>
                <div class="form-group">
                  <label for="Status">Status</label>
                  <select name="status_berita" id="Status" class="form-control" required="required">
                    <option value="">[Pilih]</option>
                    <option value="DRAF" {{ $datafind->status_berita == "DRAF" ? "selected='selected'" : '' }} >DRAF</option>
                    <option value="PUBLIC" {{ $datafind->status_berita == "PUBLIC" ? "selected='selected'" : '' }}>PUBLIC</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-default" value="Save" />
                  <input type="reset" class="btn btn-default" value="Clear">
                  <button onclick="self.history.back()" class="btn btn-primary">Back</button>
                </div>
              </form>
            </div>
            <div class="col-md-12">
             @include('content.berita.table')
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection