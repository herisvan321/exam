@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">Setting</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Setting</h3>
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
            <div class="col-md-6">
              <form action="{{ route('setting.username', base64_encode($data->id)) }}" method="post">
              	@csrf
              	@method('put')
              	  <div class="form-group">
	              	<label for="User Name">User Name</label>
	              	<input type="text" name="name" id="User Name" placeholder="Enter User Name ..." class="form-control" value="{{ $data->name }}" />
	              </div>
	              <div class="form-group">
	            	<input type="submit" class="btn btn-default" value="Update" />
	              </div>
              </form>
            </div>
           
            <div class="col-md-6">
            <form action="{{ route('setting.password', base64_encode($data->id)) }}" method="post">
              	@csrf
              	@method('put')
              <div class="form-group">
              	<label for="User Name">password</label>
              	<input type="password" name="password" id="User Name" placeholder="Enter Password ..." class="form-control"  />
              </div>
              <div class="form-group">
            	<input type="submit" class="btn btn-default" value="Update" />
              </div>
             </form>
            </div>
            <div class="col-md-12">
              <br><br>
              <h3>Admob <hr></h3>
              @if(@count($admob) > 0)
              <form method="post" action="{{ route('setting.admob.update', base64_encode($admob->id)) }}">
                @method("PUT")
              @else
              <form method="post" action="{{ route('setting.admob') }}">
              @endif
                @csrf
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="id_apl">ID APPLICATION</label>
                    <input type="text" name="id_application" id="id_apl" placeholder="Enter ID APPLICATION ..." class="form-control" value="{{ @count($admob) > 0 ? $admob->id_application : '' }}" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lable">Status Banner</label>
                    <select class="form-control" required="required" name="status_banner">
                      <option value="">[pilih]</option>
                      <option value="0" {{ @count($admob) > 0 ? $admob->status_banner == 0 ? "selected='selected'" : '' : '' }}>Non Active</option>
                      <option value="1" {{ @count($admob) > 0 ? $admob->status_banner == 1 ? "selected='selected'" : '' : '' }}>Active</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id_banner">ID BANNER</label>
                    <input type="text" name="id_banner" id="id_banner" placeholder="Enter ID BANNER ..." class="form-control" value="{{ @count($admob) > 0 ? $admob->id_banner : '' }}" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lable">Status Intetitial</label>
                    <select class="form-control" required="required" name="status_tayang">
                      <option value="">[pilih]</option>
                      <option value="0" {{ @count($admob) > 0 ? $admob->status_tayang == 0 ? "selected='selected'" : '' : '' }}>Non Active</option>
                      <option value="1" {{ @count($admob) > 0 ? $admob->status_tayang == 1 ? "selected='selected'" : '' : '' }}>Active</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id_intetitial">ID INTETiTIAL</label>
                    <input type="text" name="id_tayang" id="id_intetitial" placeholder="Enter ID INTETiTIAL ..." class="form-control" value="{{ @count($admob) > 0 ? $admob->id_tayang : '' }}" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lable">Status Native</label>
                    <select class="form-control" required="required" name="status_native">
                      <option value="">[pilih]</option>
                      <option value="0" {{ @count($admob) > 0 ? $admob->status_native == 0 ? "selected='selected'" : '' : '' }}>Non Active</option>
                      <option value="1" {{ @count($admob) > 0 ? $admob->status_native == 1 ? "selected='selected'" : '' : '' }}>Active</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="id_native">ID NATIVE</label>
                    <input type="text" name="id_native" id="id_native" placeholder="Enter ID NATIVE ..." class="form-control" value="{{ @count($admob) > 0 ? $admob->id_native : '' }}" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group"><br>
                    <input type="submit" class="btn btn-default" value="{{ @count($admob) > 0 ? 'Update' : 'Save' }}" />
                    <input type="reset" class="btn btn-default" value="Reset">
                    <button type="button" onclick="self.history.back()" class="btn btn-primary">Back</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection