 <table class="table table-bordered">
  <thead>
    <tr >
      <th>NO</th>
      <th >Title</th>
      <th >Status </th>
      <th >Soal</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  	@foreach($data as $key => $dat)
  	<tr>
  		<td>{{ $key + 1 }}</td>
  		<td>{{ $dat->title }}</td>
  		<td>
  			@if($dat->status_paket == "0")
  			Non Active
  			@elseif($dat->status_paket == "1")
  			Active
  			@endif
  		</td>
  		<td>
  			<a href="{{ route('pilih.soal.paket', base64_encode($dat->id)) }}" class="btn btn-default btn-sm">{{ @count($dat->paketSoal) }}</a>
  		</td>
  		<td>
  			<a href="{{ route('paket-ujian.edit', base64_encode($dat->id)) }}" class="btn btn-info btn-sm">Edit</a>
  		</td>
  	</tr>
  	@endforeach
  </tbody>
</table>