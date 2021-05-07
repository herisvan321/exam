 <table class="table table-bordered">
  <thead>
    <tr >
      <th>NO</th>
      <th>Title</th>
      <th >Status</th>
      <th colspan="2"></th>
    </tr>
  </thead>
  <tbody>
    @forelse($data as $key => $dat)
    <tr>
      <td>{{ $key + 1 }}</td>
      <td>{{ $dat->title }}</td>
      <td>
        @if($dat->status_tingkat == 0)
        <a href="#" class="btn btn-warning btn-sm">Non Active</a>
        @else
        <a href="#" class="btn btn-default btn-sm">Active</a>
        @endif
      </td>
      <td colspan="2">
        <a href="{{ route('tingkat.edit', base64_encode($dat->id)) }}" class="btn btn-default btn-sm">Edit</a>
        @if(@count($dat->tingkatKelas) < 1)
        <a href="{{ route('tingkat.show', base64_encode($dat->id)) }}" class="btn btn-danger btn-sm">Remove</a>
        @endif
      </td>
    </tr>
    @if(@count($dat->tingkatKelas) > 0)
      <tr class="bg-info">
        <th></th>
        <th>Title</th>
        <th>Status Kelas</th>
        <th>Jumlah Peseta</th>
        <th>Jumlah Matpel</th>
      </tr>
    @endif
      @foreach($dat->tingkatKelas as $keyy => $kelas)
      <tr>
        <td></td>
        <td><b>{{ $kelas->title }}</b></td>
        <td>
          @if($kelas->status_kelas == 0)
          <a href="#" class="btn btn-danger btn-sm">Non Active</a>
          @else
          <a href="#" class="btn btn-info btn-sm">Active</a>
          @endif
        </td>
        <td>
          {{ @count($kelas->tingkatPeserta) }}
        </td>
        <td>
          {{ @count($kelas->kelasMatpel) }}
        </td>
      </tr>
      @endforeach
      
    @empty
    <tr>
      <td colspan="4"><center>Data Tidak ada!</center></td>
    </tr>
    @endforelse
  </tbody>
</table>