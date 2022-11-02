@extends('layouts.perbankan')
<style>
    .badan_usaha_container,
    p,
    .btn {
        margin: 20px 0;
    }

    img {
        height: 400px;
    }
</style>
<?php
$baseUrl = env('APP_URL');

?>
@section('content')
<div>
    <h2>Data Tambahan</h2>
    <span class="mr-2"><a href="/perbankan/dashboard/ProfilBadanUsaha/{{$BadanUsaha->id}}">1. Profil Badan Usaha</a></span>
    <span><a href="/perbankan/dashboard/suratRekomendasi/{{$BadanUsaha->id}}">2. Surat Rekomendasi</a></span>
    <span><a href="/perbankan/dashboard/dataTambahan/{{$BadanUsaha->id}}" class="text-disetujuiTextColor">3. Data Tambahan</a></span>
</div>
<div class="bg-black w-[100%] h-[1px] mt-2"></div>
<br>
@if(is_null($dataPendukung))
<h5>Data Tambahan Tidak Ada</h5>
@else
<h1>KTP</h1>
<img class="imgSlide h-[300]" src="{{$baseUrl.'/'.$dataPendukung->ktp}}" alt="img">
<a href="{{$baseUrl.'/'.$dataPendukung->ktp}}" class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download KTP</a>
<h1>KK</h1>
<img class="imgSlide h-[300]" src="{{$baseUrl.'/'.$dataPendukung->kk}}" alt="img">
<a href="{{$baseUrl.'/'.$dataPendukung->ktp}}" class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download KK</a>


@endif

@endsection