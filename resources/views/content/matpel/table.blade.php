 <table class="table table-bordered datatable">
  <thead>
    <tr >
      <th>NO</th>
      <th>Title</th>
      <th>Kelas</th>
      <th>Tingkat</th>
      <th >Status</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @forelse($data as $key => $dat)
    <tr>
      <td>{{ $key + 1 }}</td>
      <td>{{ $dat->title }}</td>
      <td>{{ $dat->matpelKelas->title }}</td>
      <td>{{ $dat->matpelKelas->kelasTingkat->title }}</td>
      <td>
        @if($dat->status_matpel == 0)
        <a href="#" class="btn btn-warning btn-sm">Non Active</a>
        @else
        <a href="#" class="btn btn-default btn-sm">Active</a>
        @endif
      </td>

      <td>
        <a href="{{ route('matpel.edit', base64_encode($dat->id)) }}" class="btn btn-default btn-sm">Edit</a>
        @if(@count($dat->matpelUjian) < 1)
        <a href="{{ route('matpel.show', base64_encode($dat->id)) }}" class="btn btn-danger btn-sm">Remove</a>
        @endif
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="6"><center>Data Tidak ada!</center></td>
    </tr>
    @endforelse
  </tbody>
</table>