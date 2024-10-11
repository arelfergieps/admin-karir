<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pelamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body class="bg-light">
    <main class="container">
        <!-- START FORM -->
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

            <form action="" method='post'>
                @csrf
            @if (Route::current()->uri == 'apply/{id}')
                    @method('put')
                @endif
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='nama' id="nama" value="{{ old('nama', $data['nama'] ?? '') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name='email' id="email" value="{{ old('email', $data['email'] ?? '') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="no_tlp" class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='no_tlp' id="no_tlp" value="{{ old('no_tlp', $data['no_tlp'] ?? '') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='alamat' id="alamat" value="{{ old('alamat', $data['alamat'] ?? '') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="cv" class="col-sm-2 col-form-label">CV</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name='cv' id="cv">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="portofolio" class="col-sm-2 col-form-label">Portofolio</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='portofolio' id="portofolio">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
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
                        <th class="col-md-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['no_tlp'] }}</td>
                            <td>{{ $item['alamat'] }}</td>
                            {{-- <td>{{$item['cv'] }}</td> --}}
                            
                            <td> @if (filter_var($item['cv'], FILTER_VALIDATE_URL))
                                    <a href="{{ $item['cv'] }}" target="_blank">LIHAT CV</a>
                                @else
                                    Tidak tersedia
                                @endif</td>

                            <td> @if (filter_var($item['portofolio'], FILTER_VALIDATE_URL))
                                    <a href="{{ $item['portofolio'] }}" target="_blank">LIHAT PORTO</a>
                                @else
                                    Tidak tersedia
                                @endif</td>
                            <td>
                               <a href="{{ url('apply/' . $item['id']) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ url('apply/'.$item['id']) }}" method="post" onsubmit="return confirm('Apakah yakin akan melakukan penghapusan data')" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type='submit' name="submit" class="btn btn-danger btn-sm">Del</button>    
                                </form>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- AKHIR DATA -->
         @endif
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</body>

</html>
