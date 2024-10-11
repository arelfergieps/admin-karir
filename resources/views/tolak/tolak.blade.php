<html>
    <head>
        <body>
            <div id="tolak-container">
        <tbody>
    <?php $i=1;?>
    @foreach ($data as $item)
        <tr>
            <td>{{ $i }}</td>
            <td>{{ $item['nama'] }}</td>
            <td>{{ $item['email'] }}</td>
            <td>{{ $item['no_tlp'] }}</td>
            <td>{{ $item['alamat'] }}</td>
            
            <td>
                @if (filter_var($item['cv'], FILTER_VALIDATE_URL))
                    <a href="{{ $item['cv'] }}" target="_blank">LIHAT CV</a>
                @else
                    Tidak tersedia
                @endif
            </td>

            <td>
                @if (filter_var($item['portofolio'], FILTER_VALIDATE_URL))
                    <a href="{{ $item['portofolio'] }}" target="_blank">LIHAT PORTO</a>
                @else
                    Tidak tersedia
                @endif
            </td>
            <td>
                <a href="{{ url('apply/' . $item['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                
                <form action="{{ url('apply/'.$item['id']) }}" method="post" onsubmit="return confirm('Apakah yakin akan melakukan penghapusan data')" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type='submit' name="submit" class="btn btn-danger btn-sm">Del</button>    
                </form>

                <a href="javascript:void(0);" onclick="tolak({{ $item['id'] }})" class="btn btn-secondary btn-sm">Tolak</a>
            </td>
        </tr>
        <?php $i++ ?>
    @endforeach
</tbody>

    </div>
        </body>
    </head>
</html>
    

