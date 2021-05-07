@if ($errors->any())
    <div class="alert alert-danger">
    	 <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('sukses'))
<div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  {{ Session::get('sukses')}}
</div>

@elseif(Session::has('gagal'))
<div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  {{ Session::get('gagal')}}
</div>
@endif