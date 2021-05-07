@extends('layouts.template')

@section('breadcrumb')
<ul class="breadcrumb">
  <li><a href="{{ url('home') }}">Home</a></li>
  <li class="active">Dashboard</li>
</ul>
@endsection

@section('mainhome')
<div class="row">
    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon">
            <div class="widget-item-left">
                <span class="fa fa-users"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">{{ @count($loginHariIni) }}</div>
                <div class="widget-title">Login</div>
                <div class="widget-subtitle">Bulan Ini</div>
            </div>
            <div class="widget-controls">                                
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>                            
        </div>
    </div>
    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" >
            <div class="widget-item-left">
                <span class="fa fa-star"></span>
            </div>                             
            <div class="widget-data">
                <div class="widget-int num-count">{{ @count($registerBulanIni) }}</div>
                <div class="widget-title">Register</div>
                <div class="widget-subtitle">Bulan Ini</div>
            </div>      
            <div class="widget-controls">                                
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>     
    </div>
    <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" >
            <div class="widget-item-left">
                <span class="fa fa-calendar-o"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">{{ @count($historyUjian) }}</div>
                <div class="widget-title">Ujian</div>
                <div class="widget-subtitle">Bulan Ini</div>
            </div>
            <div class="widget-controls">                                
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>                            
        </div>  
    </div>
    <div class="col-md-3">
        <div class="widget widget-default widget-padding-sm">
            <div class="widget-big-int plugin-clock">00:00</div>
            <div class="widget-subtitle plugin-date">Loading...</div>
            <div class="widget-controls">                                
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>                            
            <div class="widget-buttons widget-c3">
                <div class="col">
                    <a href="#"><span class="fa fa-clock-o"></span></a>
                </div>
                <div class="col">
                    <a href="#"><span class="fa fa-bell"></span></a>
                </div>
                <div class="col">
                    <a href="#"><span class="fa fa-calendar"></span></a>
                </div>
            </div>                            
        </div>   
    </div>
        <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" >
            <div class="widget-item-left">
                <span class="fa fa-folder"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">{{ @count($soal) }}</div>
                <div class="widget-title">Soal</div>
                <div class="widget-subtitle">Semuanya</div>
            </div>
            <div class="widget-controls">                                
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>                            
        </div>  
    </div>
        <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" >
            <div class="widget-item-left">
                <span class="fa fa-calendar-o"></span> 
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">{{ @count($ujian) }}</div>
                <div class="widget-title">Ujian</div>
                <div class="widget-subtitle">Semuanya</div>
            </div>
            <div class="widget-controls">                                
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>                            
        </div>  
    </div>
        <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" >
            <div class="widget-item-left">
                <span class="fa fa-users"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">{{ @count($akun) }}</div>
                <div class="widget-title">Akun Peserta</div>
                <div class="widget-subtitle">Semuanya</div>
            </div>
            <div class="widget-controls">                                
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>                            
        </div>  
    </div>
        <div class="col-md-3">
        <div class="widget widget-default widget-item-icon" >
            <div class="widget-item-left">
                <span class="fa fa-warning"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">{{ @count($hama) }}</div>
                <div class="widget-title">Laporan Hama</div>
                <div class="widget-subtitle">Bulan Ini</div>
            </div>
            <div class="widget-controls">                                
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>                            
        </div>  
    </div>
</div>
<div class="col-md-12" style="margin-bottom:200px">
<div class="row">
  <div class="">
    <div class="panel" >
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Chart</h3>
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
        <form method="get" action="{{ route('home') }}">
            @csrf
            <input type="submit" name="btncharthari" value="7 Hari" class="btn btn-default">
            <input type="submit" name="btnchartbulan" value="1 Bulan" class="btn btn-default">
            <input type="submit" name="btnchart3bulan" value="3 Bulan" class="btn btn-default">
            <br><br>
        </form>
          <div id="container" style="width: 100%%;">
            <canvas id="myChart2"></canvas>
          </div>
            @php
              $json = [];
              $ujian = [];
              $login = [];
              $register = [];
            @endphp
            @foreach($data as $key => $v)
              @php($json[$key] = $v->dateformat)
              @php($ujian[$key] = $v->vujian)
              @php($login[$key] = $v->vlogin)
              @php($register[$key] = $v->vregister)
            @endforeach
            
      </div>
    </div>
  </div>
</div>
</div>
<script>
        var MONTHS = <?=  json_encode($json) ?>

        var barChartData = {
            labels: <?=  json_encode($json) ?>,
            datasets: [
            {
                label: 'Ujian',
                backgroundColor: "#f44242",
                data: <?=  json_encode($ujian) ?>,
                lineTension : 0.4,
                borderColor: '#f44242',
                borderWidth: 3,
                pointBackgroundColor: '#ffffff',
                pointRadius: 2
            },
            {
                label: 'Login',
                backgroundColor: "#4285f4",
                data: <?=  json_encode($login) ?>,
                lineTension : 0.4,
                borderColor: '#4285f4',
                borderWidth: 3,
                pointBackgroundColor: '#ffffff',
                pointRadius: 2
            },
            {
                label: 'Register',
                backgroundColor: "#42f4d3",
                data: <?=  json_encode($register) ?>,
                lineTension : 0.4,
                borderColor: '#42f4d3',
                borderWidth: 3,
                pointBackgroundColor: '#ffffff',
                pointRadius: 2
            },
            ]

        };

        window.onload = function() {
            var ctx = document.getElementById("myChart2").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    legend: {
                      display: false
                    },
                  scales: {
                      yAxes: [{
                        gridLines: {
                          drawBorder: false,
                          color: '#DFDFDF',
                        },
                          ticks: {
                              beginAtZero:true,
                              stepSize: 3
                          },
                      }],
                      xAxes: [{
                        ticks: {
                          display: true
                        },
                        gridLines: {
                          display: false
                        }
                      }]
                  },
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    }
                }
            });
        };
    </script>

@endsection