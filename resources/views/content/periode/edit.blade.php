@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">Periode</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Periode</h3>
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
              @include('content.periode.table')
            </div>
            <div class="col-md-4">
              <form method="post" action="{{ route('periode.update', $id) }}">
                @csrf
                @method('put')
                <div class="form-group">
                  <label for="Title">Title</label>
                  <input type="text" name="title" id="Title" placeholder="Enter Title ..." class="form-control" required="required" value="{{ $datafind->title }}" />
                </div>
                
                <div class="form-group">
                  <label for="Status">Status</label>
                  <select name="status_periode" id="Status" class="form-control" required="required">
                    <option value="">--pilih--</option>
                    <option value="0" {{ $datafind->status_periode == 0 ? "selected='selected'" : ''}}>Non Active</option>
                    <option value="1" {{ $datafind->status_periode == 1 ? "selected='selected'" : ''}}>Active</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-default" value="update" />
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