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

            <form id="applyForm" action="{{ route('apply.store') }}" method='post' enctype="multipart/form-data">
                @csrf
                @if (Route::current()->uri == 'apply/{id}')
                    @method('put')
                @endif
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name='nama' id="nama" value="{{ old('nama', $data['nama'] ?? '') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name='email' id="email" value="{{ old('email', $data['email'] ?? '') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="no_tlp" class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('no_tlp') is-invalid @enderror" name='no_tlp' id="no_tlp" value="{{ old('no_tlp', $data['no_tlp'] ?? '') }}">
                        @error('no_tlp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name='alamat' id="alamat" value="{{ old('alamat', $data['alamat'] ?? '') }}">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="cv" class="col-sm-2 col-form-label">CV</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name='cv' id="cv" accept=".pdf,.doc,.docx">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="portofolio" class="col-sm-2 col-form-label">Portofolio</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='portofolio' id="portofolio" value="{{ old('portofolio', $data['portofolio'] ?? '') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="linkdln" class="col-sm-2 col-form-label">Linkdln</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='linkdln' id="linkdln" value="{{ old('linkdln', $data['linkdln'] ?? '') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="github" class="col-sm-2 col-form-label">Posisi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='github' id="github" value="{{ old('github', $data['github'] ?? '') }}">
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
                    <th class="col-md-1">Linkdln</th>
                    <th class="col-md-1">Posisi</th>
                    <th class="col-md-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if (empty($data) || !is_array($data) || count($data) == 0)
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada data pelamar.</td>
                    </tr>
                @else
                    <?php $i = 1; ?>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['no_tlp'] }}</td>
                            <td>{{ $item['alamat'] }}</td>
                            <td><a href="{{ Route('admin.view_cv', $item['id']) }}" class="btn btn-success">Lihat PDF</a></td>
                            <td>
                                @if (filter_var($item['portofolio'], FILTER_VALIDATE_URL))
                                    <a href="{{ $item['portofolio'] }}" target="_blank">LIHAT PORTO</a>
                                @else
                                    Tidak tersedia
                                @endif
                            </td>
                            <td>
                                @if (filter_var($item['linkdln'], FILTER_VALIDATE_URL))
                                    <a href="{{ $item['linkdln'] }}" target="_blank">LIHAT Linkdln</a>
                                @else
                                    Tidak tersedia
                                @endif
                            </td>
                            <td>{{ $item['github'] }}</td>
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
                        <?php $i++; ?>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endif

        <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OgVRvuATPz50MrzZME0sA6uFlF2wN+5O+uUv4ZsLg6Vv6z9gaD/89P5jLzJ1fStZ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#applyForm').on('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman form default

                $.ajax({
                    url: $(this).attr('action'), // URL dari form
                    type: 'POST',
                    data: new FormData(this), // Mengirim data form
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            // Mengarahkan pengguna ke halaman data pelamar
                            window.location.href = '/apply'; // Ganti dengan URL yang sesuai
                        } else {
                            // Tampilkan error jika ada
                            alert(response.errors);
                        }
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
