@extends('layouts.member')
@section('content')
<div class="flex bg-white rounded-xl p-4">
    <div>
        <h2>No Kartu. {{substr($BadanUsaha->nik,strlen($BadanUsaha->nik)-4,strlen($BadanUsaha->nik))}}{{$BadanUsaha->id_cabang_industri}}{{$BadanUsaha->id_kabupaten}}</h2>
     <div class="flex">
        <div>
            <div class="flex"><div class="mr-10">Nama</div></div>
            <div class="flex"><div class="mr-10">Alamat</div></div>
            <div class="flex"><div class="mr-10">Usaha</div></div>
            <div class="flex"><div class="mr-10">Kabupaten</div></div>
            <div class="flex"><div class="mr-10">NIK</div></div>
            </div>
        <div>
            <div class="text-left flex justify-start items-start">: {{$BadanUsaha->nama_direktur}}</div>
            <div class="text-left flex justify-start items-start">: {{$BadanUsaha->alamat_lengkap}}</div>
            <div class="text-left flex justify-start items-start">: {{$BadanUsaha->nama_usaha}}</div>
            <div class="text-left flex justify-start items-start">: {{$BadanUsaha->kabupaten}}</div>
            <div class="text-left flex justify-start items-start">: {{$User->nik}}</div>
        </div>
     </div>
        
    </div>
    <img src="{{ asset('/img/kartuPhoto.png') }}" alt="">
</div>

@endsection