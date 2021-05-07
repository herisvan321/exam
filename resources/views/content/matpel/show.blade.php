@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
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
            <div class="col-md-8">
             @include('content.matpel.table')
            </div>
            <div class="col-md-4">
              <form method="post" action="{{ route('matpel.destroy', $id) }}">
                @csrf
                @method('delete')
                <div class="form-group">
                  <label for="Title">Title</label>
                  <input type="text" name="title" id="Title" placeholder="Enter Title ..." class="form-control" required="required" value="{{ $datafind->title }}" />
                </div>
                <div class="form-group">
                  <label for="Status">Status</label>
                  <select name="status_matpel" id="Status" class="form-control" required="required">
                    <option value="">--pilih--</option>
                    <option value="0" {{ $datafind->status_matpel == 0 ? "selected='selected'" : ''}}>Non Active</option>
                    <option value="1" {{ $datafind->status_matpel == 1 ? "selected='selected'" : ''}}>Active</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="submit" class="btn btn-danger" value="Remove" />
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