<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simanis</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="{{ asset('admin_template/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin_template/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('admin_template/assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />

</head>

<body>
    <div class="text-center">
        <h1>{{$title}}</h1>
    </div>
    <!-- <div class="row">
        <div class="col-sm">
            <form name="cariForm" action="{{route('chartDetail_search')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group mb-3">
                    <input style="width:200px" type="text" name="keyword" id="keyword" class="form-control" placeholder="Cari . . ." aria-label="Nama Badan Usaha" aria-describedby="button-addon2">
                    <input style="display:none" type="text" name="data" value="{{json_encode($data)}}">
                    <input style="display:none" type="text" name="filter" value="{{json_encode($filter)}}">
                    <input style="display:none" type="text" name="title" value="{{$title}}">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>

            @if($keyword != "")
            <h5>Hasil Pencarian dari : {{$keyword}}</h5>
            @endif
        </div>
    </div>
    <div class="col-sm">

    </div>
    </div> -->


    <div class="Container-Table">
        <div class="table-responsive m-2" style="max-height:500px;">
            <table class="table" style="white-space: nowrap;">
                <thead class="thead-dark bg-dark text-light" style="position: sticky; top: 0; z-index: 1;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">ALAMAT LENGKAP</th>
                        <th scope="col">NAMA USAHA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$item)
                    <tr>

                        <td scope="row" style="text-align:center;">{{ (++$key + (100* ((int)$data->currentPage() -1) ) ) }}</td>
                        <td>{{$item->nama_direktur}}</td>
                        <td>{{$item->alamat_lengkap}}</td>
                        <td>{{$item->nama_usaha}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $data->links() }}
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>