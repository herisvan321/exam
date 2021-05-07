<br>
<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th>No</th>
			<th>Title</th>
			<th>Status Posting</th>
			<th>Posting</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $key => $datas)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ Str::limit($datas->title, 20) }}</td>
			<td>{{ $datas->status_berita }}</td>
			<td>{{ date('d-m/Y H:i:s', strtotime($datas->created_at)) }}</td>
			<td>
				<a href="{{ route('berita.show', base64_encode($datas->id)) }}" class="btn btn-default btn-sm">Show</a>
			</td>
			<td>
				<a href="{{ route('berita.edit', base64_encode($datas->id)) }}" class="btn btn-info btn-sm">Edit</a>
			</td>
			<td>
				<a href="{{ route('berita.delete', base64_encode($datas->id)) }}" class="btn btn-danger btn-sm">Remove</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>