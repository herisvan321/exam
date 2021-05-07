<li class="xn-profile">
    <div class="profile">
        <div class="profile-data">
            <div class="profile-data-name">{{ Auth::user()->name }}</div>
            <div class="profile-data-title">Application Exam</div>
        </div>
    </div>                                                                        
</li>

<li class="xn-title">Home</li> 

@if($active == "home")
<li class="active">
@else
<li>
@endif
<a href="{{ url('/home') }}"><span class="fa fa-home"></span> <span class="xn-text">Dashboard</span></a></li>
<li class="xn-title">Calendar</li> 
@if($active == "periode")
<li class="active">
@else
<li>
@endif
<a href="{{ url('/home/periode') }}"><span class="fa fa-calendar-o"></span> <span class="xn-text">Periode</span></a></li>

@if($active == "hama")
<li class="active">
@else
<li>
@endif
<a href="{{ url('/home/hama') }}"><span class="fa fa-bug"></span> <span class="xn-text">Hama</span></a></li>

<li class="xn-title">Rooms</li> 
@if($active == "tingkat")
<li class="active">
@else
<li>
@endif
<a href="{{ url('/home/tingkat') }}"><span class="fa fa-caret-square-o-up"></span> <span class="xn-text">Tingkat</span></a></li>

@if($active == "kelas")
<li class="active">
@else
<li>
@endif
<a href="{{ url('/home/kelas') }}"><span class="fa fa-code-fork"></span> <span class="xn-text">Kelas</span></a></li>
<li class="xn-title">Data</li> 
@if($active == "matpel")
<li class="active">
@else
<li>
@endif
<a href="{{ url('/home/matpel') }}"><span class="fa fa-tasks"></span> <span class="xn-text">Mata Pelajaran</span></a></li>

@if($active == "soal")
<li class="active">
@else
<li>
@endif
<a href="{{ url('/home/soal') }}"><span class="fa fa-align-justify"></span> <span class="xn-text">Soal</span></a></li>


@if($active == "ujian")
<li class="active">
@else
<li>
@endif
<a href="{{ url('/home/ujian') }}"><span class="fa fa-pencil-square"></span> <span class="xn-text">Ujian</span></a></li>

<!--<li class="xn-title">Umum</li> -->
<!--@if($active == "berita")-->
<!--<li class="active">-->
<!--@else-->
<!--<li>-->
<!--@endif-->
<!--<a href="{{ route('berita.index') }}"><span class="fa fa-globe"></span> <span class="xn-text">Berita</span></a></li>-->

<!--@if($active == "pengumuman")-->
<!--<li class="active">-->
<!--@else-->
<!--<li>-->
<!--@endif-->
<!--<a href="{{ route('pengumuman.index') }}"><span class="fa fa-bullhorn"></span> <span class="xn-text">Pengumuman</span></a></li>-->

<li class="xn-title">Service</li> 
@if($active == "editor")
<li class="active">
@else
<li>
@endif
<a href="{{ route('home.editor') }}" target="_blank"><span class="fa fa-code"></span> <span class="xn-text">Editor</span></a></li>


@if($active == "setting")
<li class="active">
@else
<li>
@endif
<a href="{{ route('setting.index') }}"><span class="fa fa-gear"></span> <span class="xn-text">Setting</span></a></li>