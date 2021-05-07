 <table class="table table-bordered datatable">
  <thead>
    <tr >
      <th>NO</th>
      <th>Title</th>
      <th >Status</th>
      <th>Tingkat</th>
      <th ></th>
    </tr>
  </thead>
  <tbody>
    @forelse($data as $key => $dat)
    <tr>
      <td>{{ $key + 1 }}</td>
      <td>{{ $dat->title }}</td>
      <td>
        @if($dat->status_kelas == 0)
        <a href="#" class="btn btn-warning btn-sm">Non Active</a>
        @else
        <a href="#" class="btn btn-default btn-sm">Active</a>
        @endif
      </td>
      <td>{{ $dat->kelasTingkat->title }}</td>
      <td >
        <a href="{{ route('kelas.edit', base64_encode($dat->id)) }}" class="btn btn-default btn-sm">Edit</a>
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="5"><center>Data Tidak ada!</center></td>
    </tr>
    @endforelse
  </tbody>
</table>