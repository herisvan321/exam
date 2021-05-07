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
            	<form action="{{ route('jawaban.destroy', $id) }}" method="post">
            		@csrf
            		@method('delete')
            		<div class="form-group">
            			<label for="Objectif">Objectif</label>
            			<input type="text" name="objectif" id="Objectif" placeholder="Enter Objectif A/B/C/D/E..." class="form-control" required="required" value="{{ $data->objectif }}" />
            		</div>
            		<div class="form-group">
            		<label for="lable">Content</label><br>
            			@if($datafind->jenis_soal == 0 || $datafind->jenis_soal == 4 || $datafind->jenis_soal == 5 || $datafind->jenis_soal == 6)
				      	<textarea class="form-control" name="content" placeholder="Enter Jawaban Text" required="required">{{ $data->content }}</textarea>
				      	@elseif($datafind->jenis_soal == 1 || $datafind->jenis_soal == 7 || $datafind->jenis_soal == 11 || $datafind->jenis_soal == 15)
				      	<img src="{{ asset('/upload/banksoal/'.$data->content)  }}" style="width: 350px; height: 350px;">
				      	@elseif($datafind->jenis_soal == 2 || $datafind->jenis_soal == 8 || $datafind->jenis_soal == 10 || $datafind->jenis_soal == 14)
				      	<audio controls>
                  <source src="{{ asset('/upload/banksoal/'.$data->content)  }}" type="audio/mpeg">
                  <source src="{{ asset('/upload/banksoal/'.$data->content)  }}" type="audio/ogg">
                </audio>
				      	@elseif($datafind->jenis_soal == 3 || $datafind->jenis_soal == 9 || $datafind->jenis_soal == 12 || $datafind->jenis_soal == 13)
				      	<video controls style="width: 250px; height: 150px;">
                    <source src="{{ asset('/upload/banksoal/'.$data->content)  }}" type="video/mp4">
                    <source src="{{ asset('/upload/banksoal/'.$data->content)  }}" type="video/ogg">
                </video>
				      	@endif
            		</div>
            		<div class="form-group">
            			<input type="submit" value="Remove" class="btn btn-danger">
            			<button type="button" onclick="self.history.back()" class="btn btn-primary">Back</button>
            		</div>
            	</form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection