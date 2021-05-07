 <table class="table table-bordered">
  <thead>
    <tr >
      <th>NO</th>
      <th>Tingkat</th>
      <th>Kelas</th>
      <th>MatPel</th>
      <th >Periode</th>
      <th >Title</th>
      <th >Soal</th>
      <th >Status </th>
      <th >Alokasi</th>
      <th >Paket</th>
      <th ></th>
    </tr>
  </thead>
  <tbody>
  	@foreach($data as $key => $dat)
  	<tr>
  		<td>{{ $key + 1 }}</td>
  		<td>{{ $dat->ujianMatpel->matpelKelas->kelasTingkat->title }}</td>
  		<td>{{ $dat->ujianMatpel->matpelKelas->title }}</td>
  		<td>{{ $dat->ujianMatpel->title }}</td>
  		<td>{{ $dat->ujianPeriode->title }}</td>
  		<td>{{ $dat->title }}</td>
  		<td>{{ $dat->jlm_soal }}</td>
  		<td @if($dat->status_ujian == 0) {{ 'style=background:red' }} @endif>
  			@if($dat->status_ujian == 0)
  			Non Active
  			@elseif($dat->status_ujian == 1)
  			Active
  			@endif

  		</td>
  		<td >{{ $dat->alokasi_waktu." Menit" }}</td>
  		<td>
  			<a href="{{ url('/home/ujian/paket/'.base64_encode($dat->id)) }}" class="btn btn-default btn-sm">{{ @count($dat->ujianPaket) }}</a>
  			
  		</td>
      <td>
        <a href="{{ route('data-ujian.edit', base64_encode($dat->id)) }}" class="btn btn-info btn-sm">Edit</a>
      </td>
  	</tr>
  	@endforeach
  </tbody>
</table>

{{ $data->links() }}