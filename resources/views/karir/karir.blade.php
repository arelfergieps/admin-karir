{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Karir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    </head>

<body class="bg-light">
    <main class="container">
        
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm"> --}}
        @extends('layout.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper ">
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
<div class="container">
            <form action='' method='post'class="">
                @csrf

                @if (Route::current()->uri == 'karir/{id}')
                @method('put')
                @endif

                <div class="mb-3 row">
                    <label for="job_title" class="col-sm-2 col-form-label"></label>
                    <br>
                    <div class="col-sm-10 offset-sm-2">
                        <input type="text" placeholder="Job Title" class="form-control" name='job_title' id="job_title" value="{{ isset($data['job_title']) ? $data['job_title'] : old('job_title') }}">
                    </div>
                </div>

                <div class="mb-3 row">
    <label for="description" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-11 offset-sm-2">
        <textarea name="description" class="form-control mySummernote" id="description">
            {{ isset($data['description']) ? $data['description'] : old('description') }}
        </textarea>
    </div>
</div>

{{-- Location --}}
                <div class="mb-3 row">
                    <label for="location" class="col-sm-2 col-form-label"></label><br>
                    <div class="col-sm-10 offset-sm-2">
                        <input type="text" class="form-control" placeholder="Location" name='location' id="location" value="{{ isset($data['location']) ? $data['location'] : old('location') }}">
                    </div>
                </div>

                <!-- Tambahan kolom baru -->
               <div class="mb-3 row">
    <label for="kategori" class="col-sm-2 col-form-label"></label><br>
    <div class="col-sm-10 offset-sm-2">
        <select class="form-control" placeholder="Kategori" name="kategori" id="kategori">
            <option value="FULL TIME" {{ (isset($data['kategori']) && $data['kategori'] == 'FULL TIME') ? 'selected' : '' }}>FULL TIME</option>
            <option value="INTERN" {{ (isset($data['kategori']) && $data['kategori'] == 'INTERN') ? 'selected' : '' }}>INTERN</option>
            <option value="PART TIME" {{ (isset($data['kategori']) && $data['kategori'] == 'PART TIME') ? 'selected' : '' }}>PART TIME</option>
            <option value="FREELANCE" {{ (isset($data['kategori']) && $data['kategori'] == 'FREELANCE') ? 'selected' : '' }}>FREELANCE</option>
        </select>
    </div>
</div>
               <div class="mb-3 row">
            <label for="kualifikasi" class="col-sm-2 col-form-label"></label><br>
            <div class="col-sm-10  offset-sm-2">
                <textarea name="kualifikasi" class="form-control mySummernote" id="kualifikasi">{{ isset($data['kualifikasi']) ? $data['kualifikasi'] : old('kualifikasi') }}</textarea>
            </div>
        </div>

               <div class="mb-3 row">
    <label for="divisi" class="col-sm-2 col-form-label"></label><br>
    <div class="col-sm-10 offset-sm-2">
        <select class="form-control" name="divisi" id="divisi" onchange="toggleInput(this)">
            <option value="">Pilih Divisi</option>
            <option value="Pengembangan Produk" {{ (isset($data['divisi']) && $data['divisi'] == 'Pengembangan Produk') ? 'selected' : '' }}>Pengembangan Produk</option>
            <option value="Teknologi Informasi" {{ (isset($data['divisi']) && $data['divisi'] == 'Teknologi Informasi') ? 'selected' : '' }}>Teknologi Informasi</option>
            <option value="Pengembangan Perangkat Lunak" {{ (isset($data['divisi']) && $data['divisi'] == 'Pengembangan Perangkat Lunak') ? 'selected' : '' }}>Pengembangan Perangkat Lunak</option>
            <option value="Analisis Data" {{ (isset($data['divisi']) && $data['divisi'] == 'Analisis Data') ? 'selected' : '' }}>Analisis Data</option>
            <option value="Pemasaran Digital" {{ (isset($data['divisi']) && $data['divisi'] == 'Pemasaran Digital') ? 'selected' : '' }}>Pemasaran Digital</option>
            <option value="Manajemen Proyek" {{ (isset($data['divisi']) && $data['divisi'] == 'Manajemen Proyek') ? 'selected' : '' }}>Manajemen Proyek</option>
            <option value="Layanan Pelanggan" {{ (isset($data['divisi']) && $data['divisi'] == 'Layanan Pelanggan') ? 'selected' : '' }}>Layanan Pelanggan</option>
            <option value="Keamanan Informasi" {{ (isset($data['divisi']) && $data['divisi'] == 'Keamanan Informasi') ? 'selected' : '' }}>Keamanan Informasi</option>
            <option value="Pengembangan Bisnis" {{ (isset($data['divisi']) && $data['divisi'] == 'Pengembangan Bisnis') ? 'selected' : '' }}>Pengembangan Bisnis</option>
            <option value="Sumber Daya Manusia" {{ (isset($data['divisi']) && $data['divisi'] == 'Sumber Daya Manusia') ? 'selected' : '' }}>Sumber Daya Manusia</option>
            <option value="Desain UI/UX" {{ (isset($data['divisi']) && $data['divisi'] == 'Desain UI/UX') ? 'selected' : '' }}>Desain UI/UX</option>
            <option value="Konsultasi IT" {{ (isset($data['divisi']) && $data['divisi'] == 'Konsultasi IT') ? 'selected' : '' }}>Konsultasi IT</option>
            <option value="Keuangan dan Akuntansi" {{ (isset($data['divisi']) && $data['divisi'] == 'Keuangan dan Akuntansi') ? 'selected' : '' }}>Keuangan dan Akuntansi</option>
            <option value="Riset dan Pengembangan" {{ (isset($data['divisi']) && $data['divisi'] == 'Riset dan Pengembangan') ? 'selected' : '' }}>Riset dan Pengembangan</option>
        </select>
        <input type="text" class="form-control mt-2" name="custom_divisi" id="custom_divisi" placeholder="Atau masukkan divisi lainnya" value="{{ isset($data['divisi']) ? $data['divisi'] : old('divisi') }}" style="display: none;">
    </div>
</div>
                <div class="mb-3 row">
                    <label for="gaji" class="col-sm-2 col-form-label"></label><br>
                    <div class="col-sm-10 offset-sm-2">
                        <input type="text" class="form-control" placeholder="Gaji" name='gaji' id="gaji" value="{{ isset($data['gaji']) ? $data['gaji'] : old('gaji') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="status" class="col-sm-2 col-form-label"></label><br>
                    <div class="col-sm-10 offset-sm-2">
                        <select class="form-select" name="status" id="status">
                            <option value="1" {{ isset($data['status']) && $data['status'] == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="2" {{ isset($data['status']) && $data['status'] == 2 ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-12 offset-sm-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
       
    </main>
      </div><!-- /.content-wrapper -->
      </div>

 <!-- AKHIR FORM -->
<div class="container">
        @if (Route::current()->uri == 'karir')
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm table-responsive">
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
    <?php $i = 1; ?>
    @if(!empty($data) && $data->count())
        @foreach ($data as $item)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $item['job_title'] }}</td>
            <td>{!! Str::words($item['description'], 20, '...') !!}</td> <!-- Batasi deskripsi -->
            <td>{{ $item['location'] }}</td>
            <td>{{ $item['kategori'] }}</td>
            <td>{!! Str::words($item['kualifikasi'], 20, '...') !!}</td> <!-- Batasi kualifikasi -->
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
        <?php $i++; ?>
        @endforeach
    @else
        <tr>
            <td colspan="10" class="text-center">Data tidak tersedia</td>
        </tr>
    @endif
</tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->
        @endif









           

 
@endsection
{{-- </body>

</html> --}}
