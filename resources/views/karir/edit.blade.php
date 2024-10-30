<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Karir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    </head>

<body class="bg-light">
    <main class="container">
        <!-- START FORM -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action='{{ url("karir/{$data['id']}") }}' method='post'>
                @csrf
                @method('PUT')

                <div class="mb-3 row">
                    <label for="job_title" class="col-sm-2 col-form-label">Job Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='job_title' id="job_title" value="{{ old('job_title', $data['job_title'] ?? '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control mySummernote" id="description">{{ old('description', $data['description'] ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="location" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='location' id="location" value="{{ old('location', $data['location'] ?? '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="kategori" id="kategori">
                            <option value="FULL TIME" {{ old('kategori', $data['kategori'] ?? '') == 'FULL TIME' ? 'selected' : '' }}>FULL TIME</option>
                            <option value="INTERN" {{ old('kategori', $data['kategori'] ?? '') == 'INTERN' ? 'selected' : '' }}>INTERN</option>
                            <option value="PART TIME" {{ old('kategori', $data['kategori'] ?? '') == 'PART TIME' ? 'selected' : '' }}>PART TIME</option>
                            <option value="FREELANCE" {{ old('kategori', $data['kategori'] ?? '') == 'FREELANCE' ? 'selected' : '' }}>FREELANCE</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="kualifikasi" class="col-sm-2 col-form-label">Kualifikasi</label>
                    <div class="col-sm-10">
                        <textarea name="kualifikasi" class="form-control mySummernote" id="kualifikasi">{{ old('kualifikasi', $data['kualifikasi'] ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="divisi" class="col-sm-2 col-form-label">Divisi</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="divisi" id="divisi" onchange="toggleInput(this)">
                            <option value="">Pilih Divisi</option>
                            <option value="Pengembangan Produk" {{ old('divisi', $data['divisi'] ?? '') == 'Pengembangan Produk' ? 'selected' : '' }}>Pengembangan Produk</option>
                            <option value="Teknologi Informasi" {{ old('divisi', $data['divisi'] ?? '') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                            <option value="Pengembangan Perangkat Lunak" {{ old('divisi', $data['divisi'] ?? '') == 'Pengembangan Perangkat Lunak' ? 'selected' : '' }}>Pengembangan Perangkat Lunak</option>
                            <option value="Lainnya" {{ old('divisi', $data['divisi'] ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        <input type="text" class="form-control mt-2" name="custom_divisi" id="custom_divisi" placeholder="Atau masukkan divisi lainnya" value="{{ old('custom_divisi', $data['custom_divisi'] ?? '') }}" style="display: none;">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="gaji" class="col-sm-2 col-form-label">Gaji</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='gaji' id="gaji" value="{{ old('gaji', $data['gaji'] ?? '') }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="status" id="status">
                            <option value="1" {{ old('status', $data['status'] ?? '') == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="2" {{ old('status', $data['status'] ?? '') == 2 ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- END FORM -->
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.mySummernote').summernote({
                height: 300
            });
        });

        function toggleInput(select) {
            const customDivisiInput = document.getElementById('custom_divisi');
            customDivisiInput.style.display = select.value === 'Lainnya' ? 'block' : 'none';
        }
    </script>
</body>

</html>
