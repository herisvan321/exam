@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">{{ ucwords($kondisi) }}</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">{{ ucwords($kondisi) }}</h3>
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
         @if($kondisi == 'soal')
         	@if($datafind->jenis_soal == 0 || $datafind->jenis_soal == 1 || $datafind->jenis_soal == 2 || $datafind->jenis_soal == 3)
		  	{!! $datafind->soal !!}
		  	@elseif($datafind->jenis_soal == 4 || $datafind->jenis_soal == 7 || $datafind->jenis_soal == 8 || $datafind->jenis_soal == 9)
		  	<img src="{{ asset('/upload/banksoal/'.$datafind->soal)  }}" style="width: 350px; height: 350px;">
		  	<hr>
         	{!! $datafind->keterangan !!}
		  	@elseif($datafind->jenis_soal == 5 || $datafind->jenis_soal == 10 || $datafind->jenis_soal == 11 || $datafind->jenis_soal == 12)
		  	<audio controls>
		  		<source src="{{ asset('/upload/banksoal/'.$datafind->soal)  }}" type="audio/mpeg">
          <source src="{{ asset('/upload/banksoal/'.$datafind->soal)  }}" type="audio/ogg">
		  	</audio>
		  	<hr>
         	{!! $datafind->keterangan !!}
		  	@elseif($datafind->jenis_soal == 6 || $datafind->jenis_soal == 13 || $datafind->jenis_soal == 14 || $datafind->jenis_soal == 15)
		  	<video controls style="width: 100%; height: 150px;">
	            <source src="{{ asset('/upload/banksoal/'.$datafind->soal)  }}" type="video/mp4">
	            <source src="{{ asset('/upload/banksoal/'.$datafind->soal)  }}" type="video/ogg">
	        </video>
		  	<hr>
         	{!! $datafind->keterangan !!}
		  	@endif
         @elseif($kondisi == 'keterangan')
         {!! $datafind->keterangan !!}
         @endif
      </div>
    </div>
  </div>
</div>
@endsection