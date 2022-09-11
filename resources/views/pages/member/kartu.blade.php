@extends('layouts.member')
@section('content')
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
    <img class="w-[200px] w-[200px] m-3" src="{{ asset($User->foto) }}" alt="">
</div>
<br>
<h5>Ganti Foto</h5>
<form action="/ganti/foto" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="foto" accept="image/x-png,image/gif,image/jpeg" required>
    <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Submit</button>
</form>

@endsection