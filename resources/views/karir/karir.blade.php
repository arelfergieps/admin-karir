<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Buku</title>
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

            <form action='' method='post'>
                @csrf

                @if (Route::current()->uri == 'karir/{id}')
                @method('put')
                @endif
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Job Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='job_title' id="job_title" value="{{ isset ($data['job_title'])?$data['job_title']:old('job_title') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='description' id="description" value="{{ isset ($data['description'])?$data['description']:old('description') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='location' id="location"value="{{ isset ($data['location'])?$data['location']:old('location') }}">
                    </div>
                </div>
        
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->
@if (Route::current()->uri == 'karir')
    
        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-4">Job Title</th>
                        <th class="col-md-3">Description</th>
                        <th class="col-md-2">Location</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;?>
                    @foreach ($data as $item)
                        <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item['job_title'] }}</td>
                        <td>{{ $item['description'] }}</td>
                        <td>{{ $item['location'] }}</td>
                        <td>
                           <a href="{{ url('karir/' . $item['id']) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ url('karir/'.$item['id']) }}" method="post" onsubmit="return confirm 
                            ('Apakah yakin akan melakukan penghapusan data')" class="d-inline">
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
    <!-- Include jQuery and jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

<script>
    $(function() {
        var availableLocations = [
            "Jakarta",
            "Surabaya",
            "Bali",
            "Bandung",
            "Yogyakarta",
            "Semarang",
            "Medan",
            "Makassar",
            "Palembang",
            "Denpasar"
            "Malang"
            "Banyuwangi"

            // Add more as needed or fetch from API
        ];
        $("#location").autocomplete({
            source: availableLocations
        });
    });
</script>


</body>

</html>