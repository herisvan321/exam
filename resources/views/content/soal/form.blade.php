@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li><a href="{{ url('home/soal') }}">Soal</a></li>
  <li><a href="{{ url('home/matpel') }}">Mata Pelajaran</a></li>
  <li class="active">Soal</li>
</ul>
@endsection


@section('mainhome')
<div class="row">
  <div class="">
    <div class="panel" style="min-height: 100vh;">
      <div class="panel-heading">
        <h3 class="panel-title">Soal</h3>
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
            	<form action="{{ route('bank-soal.store') }}" method="post" id="form1" enctype="multipart/form-data">
            		@csrf
            		<input type="hidden" name="data_id" value="{{$id}}">
            		<input type="hidden" name="kondisi" value="{{ base64_encode($kondisi) }}">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="lable">Lable</label>
                        <textarea name="lable" id="lable" class="form-control"></textarea>
                    </div>
                    </div>
            		@if($kondisi == 'text')
            		<div class="col-md-12">
            			<div class="form-group">
            				<label for="lable">Soal <span style="color:red">*</span></label>
            				<textarea class="ckeditor" id="ckeditor" name="soal"></textarea>
            			</div>
            		</div>
            		@elseif($kondisi == 'text-media')
            		<div class="col-md-5">
            			<div class="form-group">
            				<label for="Jenis_Media">Jenis Jawaban <span style="color:red">*</span></label>
            				<select name="jenis_soal" id="Jenis_Media" required="required" class="form-control">
            					<option value="">--pilih--</option>
            					<option value="1">Image</option> <!-- id=1 text-image -->
            					<option value="2">Audio</option> <!-- id=2 text-audio -->
            					<!-- <option value="3">Video</option> <!-- id=3 text-video --> -->
            				</select>
            			</div>
            		</div>
            		<div class="col-md-12">
            			<div class="form-group">
            				<label for="lable">Soal <span style="color:red">*</span></label>
            				<textarea class="ckeditor" id="ckeditor" name="soal"></textarea>
            			</div>
            		</div>
            		@elseif($kondisi == 'media-text')
            		<div class="col-md-6">
            			<div class="form-group">
            				<label for="Jenis_Media">Jenis Soal <span style="color:red">*</span></label>
            				<select name="jenis_soal" id="Jenis_Media" required="required" class="form-control">
            					<option value="">--pilih--</option>
            					<option value="4">Image</option> <!-- id=4 image-text -->
            					<option value="5">Audio</option> <!-- id=5 audio-text -->
            					<!-- <option value="6">Video</option> <!-- id=6 video-text --> -->
            				</select>
            			</div>
            		</div>
            		<div class="col-md-6">
            			<div class="form-group">
            				<label for="lable">Soal <span style="color:red">*</span></label>
            				<input type="file" name="soal" class="form-control" placeholder="Enter Url ..." required="required">
            			</div>
            		</div>
            		<div class="col-md-12">
            			<div class="form-group">
            				<label for="lable">Keterangan</label>
            				<textarea class="ckeditor" id="ckeditor" name="keterangan"></textarea>
            			</div>
            		</div>
            		@elseif($kondisi == 'full-media')
            		<div class="col-md-6">
            			<div class="form-group">
            				<label for="Jenis_Media">Jenis Soal dan Jawaban <span style="color:red">*</span></label>
            				<select name="jenis_soal" id="Jenis_Media" required="required" class="form-control">
            					<option value="">--pilih--</option>
            					<option value="7">Image - Image</option> 
            					<!-- <option value="8">Image - Audio</option> 
            					<option value="9">Image - Video</option> 
            					<option value="10">Audio - Audio</option> -->
            					<option value="11">Audio - Image</option> 
            					<!--<option value="12">Audio - Video</option> 
            					<option value="13">Video - Video</option> 
            					<option value="14">Video - Audio</option>  -->
            					<option value="15">Video - Image</option> 
            				</select>
            			</div>
            		</div>
            		<div class="col-md-6">
            			<div class="form-group">
            				<label for="lable">Soal</label>
            				<input type="file" name="soal" class="form-control" placeholder="Enter Url ..." required="required">
            			</div>
            		</div>
            		<div class="col-md-12">
            			<div class="form-group">
            				<label for="lable">Keterangan</label>
            				<textarea class="ckeditor" id="ckeditor" name="keterangan"></textarea>
            			</div>
            		</div>
            		@endif
            		<div class="col-md-4">
            			<div class="form-group">
            				<label for="Jawaban">Jumlah Jawaban <span style="color:red">*</span></label>
            				<select class="form-control" required="required" name="jlm_jawaban" id="select1"
onchange="tampilkan()">
            					<option value="">--pilih--</option>
            					<option value="1">1</option>
            					<option value="2">2</option>
            					<option value="3">3</option>
            					<option value="4">4</option>
            					<option value="5">5</option>
            				</select>
            			</div>
            		</div>
            		<div class="col-md-4">
            			<div class="form-group">
            				<label for="Jawaban">Jawaban <span style="color:red">*</span></label>
            				 <select class="form-control" required="required" name="jawaban" id="data">
            				 	<option value="">--pilih--</option>
            				 </select>
            			</div>
            		</div>
            		<div class="col-md-4">
            			<div class="form-group">
            				<label for="Skor_Soal">Skor Soal <span style="color:red">*</span></label>
            				<input type="text" name="skor_soal" id="Skor_Soal" placeholder="Enter Skor Soal ..." class="form-control" required="required" />
            			</div>
            		</div>
            		<div class="col-md-12">
            			<div class="form-group">
            				<br>
            				<p><span style="color:red">*</span>). wajib diisi!</p>
            				<input type="submit" value="Save" class="btn btn-default">
            				<input type="reset" class="btn btn-default" value="Clear">
            				<button type="button" class="btn btn-primary">Back</button>
            			</div>
            		</div>
            	</form>
          </div>
      </div>
    </div>
  </div>
</div>
<script>
function tampilkan(){

  var nama_data=document.getElementById("form1").select1.value;
  var p_kontainer=document.getElementById("data");

    if (nama_data=="1"){
    	// alert("hoo");
        var dataselect = '<select class="form-control" required="required" name="jawaban"><option value="">--pilih--</option><option value="A">A</option></select>';
        p_kontainer.innerHTML = dataselect;
    }else if (nama_data=="2"){
    	// alert("hoo");
        var dataselect = '<select class="form-control" required="required" name="jawaban"><option value="">--pilih--</option><option value="A">A</option><option value="B">B</option></select>';
        p_kontainer.innerHTML = dataselect;
    }else if (nama_data=="3"){
    	// alert("hoo");
        var dataselect = '<select class="form-control" required="required" name="jawaban"><option value="">--pilih--</option><option value="A">A</option><option value="B">B</option><option value="C">C</option></select>';
        p_kontainer.innerHTML = dataselect;
    }else if (nama_data=="4"){
    	// alert("hoo");
        var dataselect = '<select class="form-control" required="required" name="jawaban"><option value="">--pilih--</option><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option></select>';
        p_kontainer.innerHTML = dataselect;
    }else if (nama_data=="5"){
    	// alert("hoo");
        var dataselect = '<select class="form-control" required="required" name="jawaban"><option value="">--pilih--</option><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option></select>';
        p_kontainer.innerHTML = dataselect;
    }
    else{
      p_kontainer.innerHTML='<select class="form-control" required="required" name="jawaban"><option value="">--pilih--</option></select>';
   }
}
</script>
@endsection