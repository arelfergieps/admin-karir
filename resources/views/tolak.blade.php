    
{{-- </body>
</html> --}}






@extends('layout.main')
@section('content')

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <section class="content-header">
           <h1>
            Dashboard
            <small>karir</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section> --}}

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h2>Daftar Pelamar yang Di Tolak</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>CV</th>
                    <th>Portofolio</th>
                    <th>LinkedIn</th>
                    <th>Posisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (empty($data))
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada pelamar yang diterima.</td>
                    </tr>
                @else
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['no_tlp'] }}</td>
                            <td>{{ $item['alamat'] }}</td>
                            <td><a href="{{ route('admin.view_cv', $item['id']) }}" class="btn btn-success">Lihat PDF</a></td>
                            <td>
                                @if (isset($item['portofolio']) && filter_var($item['portofolio'], FILTER_VALIDATE_URL))
                                    <a href="{{ $item['portofolio'] }}" target="_blank">Lihat Portofolio</a>
                                @else
                                    Tidak tersedia
                                @endif
                            </td>
                            <td>
                                @if (isset($item['linkdln']) && filter_var($item['linkdln'], FILTER_VALIDATE_URL))
                                    <a href="{{ $item['linkdln'] }}" target="_blank">Lihat LinkedIn</a>
                                @else
                                    Tidak tersedia
                                @endif
                            </td>
                            <td>{{ $item['github'] }}</td>
                            <td>
                                <form action="{{ url('apply/'.$item['id']) }}" method="post" onsubmit="return confirm('Apakah yakin akan melakukan penghapusan data')" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type='submit' name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection