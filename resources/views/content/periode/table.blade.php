 <table class="table table-bordered">
  <thead>
    <tr >
      <th>NO</th>
      <th>Title</th>
      <th colspan="2">Status</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @forelse($data as $key => $dat)
    <tr>
      <td>{{ $key + 1 }}</td>
      <td>{{ $dat->title }}</td>
      <td colspan="2">
        @if($dat->status_periode == 0)
        <a href="#" class="btn btn-warning btn-sm">Non Active</a>
        @else
        <a href="#" class="btn btn-default btn-sm">Active</a>
        @endif
      </td>
      <td>
        <a href="{{ route('periode.edit', base64_encode($dat->id)) }}" class="btn btn-default btn-sm">Edit</a>
        @if(@count($dat->periodeUjian) < 1)
        <a href="{{ route('periode.show', base64_encode($dat->id)) }}" class="btn btn-danger btn-sm">Remove</a>
        @endif
      </td>
    </tr>
    
      
    @empty
    <tr>
      <td colspan="4"><center>Data Tidak ada!</center></td>
    </tr>
    @endforelse
  </tbody>
</table>