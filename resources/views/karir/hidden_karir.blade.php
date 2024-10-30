{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Hidden Karir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body class="bg-light">
    <main class="container"> --}}
      
  

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html> --}}







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
          <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-2">Job Title</th>
                        <th class="col-md-2">Description</th>
                        <th class="col-md-2">Location</th>
                        <th class="col-md-1">Kategori</th>
                        <th class="col-md-2">Kualifikasi</th>
                        <th class="col-md-2">Divisi</th>
                        <th class="col-md-1">Gaji</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
              <tbody>
    @if (count($data) > 0)
        @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['job_title'] }}</td>
                <td>{!! $item['description'] !!}</td>
                <td>{{ $item['location'] }}</td>
                <td>{{ $item['kategori'] }}</td>
                <td>{!! $item['kualifikasi'] !!}</td>
                <td>{{ $item['divisi'] }}</td>
                <td>{{ $item['gaji'] }}</td>
                <td>
                    @if ($item['status'] == 1)
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-danger">Non-Aktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ url('karir/' . $item['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ url('karir/'.$item['id']) }}" method="post" onsubmit="return confirm('Apakah yakin akan melakukan penghapusan data')" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type='submit' name="submit" class="btn btn-danger btn-sm">Del</button>
                    </form>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="10" class="text-center">Tidak ada data yang ditemukan.</td>
        </tr>
    @endif
</tbody>
           </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->
    </main>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection