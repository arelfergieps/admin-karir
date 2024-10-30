


@extends('layout.main')
@section('content')

<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
           <h1>
            Dashboard
            <small>karir</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            
        </div>
        <!-- AKHIR FORM -->

      @if (Route::current()->uri == 'apply')
    <!-- START DATA -->
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-md-1">No</th>
                    <th class="col-md-2">Nama</th>
                    <th class="col-md-2">Email</th>
                    <th class="col-md-2">No. Telepon</th>
                    <th class="col-md-2">Alamat</th>
                    <th class="col-md-1">CV</th>
                    <th class="col-md-1">Portofolio</th>
                    <th class="col-md-1">Linkdln</th>
                    <th class="col-md-1">Posisi</th>
                    <th class="col-md-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
               @if ($data->count() > 0)
    @foreach ($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->no_tlp }}</td>
            <td>{{ $item->alamat }}</td>
            <td><a href="{{ route('admin.view_cv', $item->id) }}" class="btn btn-success">Lihat PDF</a></td>
            <td>
                @if (filter_var($item->portofolio, FILTER_VALIDATE_URL))
                    <a href="{{ $item->portofolio }}" target="_blank">LIHAT PORTO</a>
                @else
                    Tidak tersedia
                @endif
            </td>
            <td>
                @if (filter_var($item->linkdln, FILTER_VALIDATE_URL))
                    <a href="{{ $item->linkdln }}" target="_blank">LIHAT Linkdln</a>
                @else
                    Tidak tersedia
                @endif
            </td>
            <td>{{ $item->github }}</td>
                            <td>
                                <form action="{{ url('apply/'.$item['id'].'/accept') }}" method="post" class="d-inline">
                                    @csrf
                                    <button type='submit' class="btn btn-success btn-sm">Terima</button>
                                </form>
                                <form action="{{ url('apply/'.$item['id'].'/reject') }}" method="post" class="d-inline" onsubmit="return confirm('Apakah yakin akan menolak pelamar ini?')">
                                    @csrf
                                    <button type='submit' class="btn btn-danger btn-sm">Tolak</button>
                                </form>
                                <form action="{{ url('apply/'.$item['id']) }}" method="post" onsubmit="return confirm('Apakah yakin akan melakukan penghapusan data')" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type='submit' name="submit" class="btn btn-danger btn-sm">Del</button>
                                </form>
                            </td>
                        </tr>
                
                    @endforeach
                    @else
    <tr>
        <td colspan="10" class="text-center">Tidak ada data pelamar.</td>
    </tr>
@endif
                @endif

            </tbody>
        </table>
    </div>


        <!-- AKHIR DATA -->
    </main>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection