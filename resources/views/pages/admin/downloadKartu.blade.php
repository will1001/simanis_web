<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Simanis</title>
</head>
<body>
<div class="flex bg-white rounded-xl p-4">
    <div>
        <h2>No Kartu. {{substr($BadanUsaha[0]->nik,strlen($BadanUsaha[0]->nik)-4,strlen($BadanUsaha[0]->nik))}}{{$BadanUsaha[0]->id_cabang_industri}}{{$BadanUsaha[0]->id_kabupaten}}</h2>
     <div class="flex">
        <div>
            <div class="flex"><div class="mr-10">Nama</div></div>
            <div class="flex"><div class="mr-10">Alamat</div></div>
            <div class="flex"><div class="mr-10">Usaha</div></div>
            <div class="flex"><div class="mr-10">Kabupaten</div></div>
            <div class="flex"><div class="mr-10">NIK</div></div>
            </div>
        <div>
            <div class="text-left flex justify-start items-start">: {{$BadanUsaha[0]->nama_direktur}}</div>
            <div class="text-left flex justify-start items-start">: {{$BadanUsaha[0]->alamat_lengkap}}</div>
            <div class="text-left flex justify-start items-start">: {{$BadanUsaha[0]->nama_usaha}}</div>
            <div class="text-left flex justify-start items-start">: {{$BadanUsaha[0]->kabupaten}}</div>
            <div class="text-left flex justify-start items-start">: {{$User->nik}}</div>
        </div>
     </div>
        
    </div>
    <img class="w-[200px] m-3" src="{{ asset($User->foto) }}" alt="">
</div>
</body>
<script>
    print();
</script>
</html>