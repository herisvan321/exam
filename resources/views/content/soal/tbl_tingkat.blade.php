 <table class="table table-bordered">
  <thead>
    <tr >
      <th>NO</th>
      <th>Title</th>
      <th >Status</th>
      <th colspan="4"></th>
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
      <td colspan="4">
      </td>
    </tr>
    @if(@count($dat->tingkatKelas) > 0)
      <tr class="bg-info">
        <th></th>
        <th>Title</th>
        <th>Status Kelas</th>
        <th>Jumlah Peseta</th>
        <th>Jumlah Soal</th>
        <th>Jumlah Matpel</th>
        <th></th>
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
          {{ @count($kelas->tingkatBankSoal) }}
        </td>
        <td>
          {{ @count($kelas->kelasMatpel) }}
        </td>
        <td>
        	<a href="{{ url('/home/soal/matpel/'. base64_encode($kelas->id)) }}" class="btn btn-info btn-sm">Pilih</a>
        </td>
      </tr>
      @endforeach
      
    @empty
    <tr>
      <td colspan="6"><center>Data Tidak ada!</center></td>
    </tr>
    @endforelse
  </tbody>
</table>