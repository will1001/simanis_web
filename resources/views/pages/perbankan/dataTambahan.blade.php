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
   <span class="mr-2"><a  href="/perbankan/dashboard/ProfilBadanUsaha/{{$BadanUsaha->id}}" >1. Profil Badan Usaha</a></span>
   <span><a href="/perbankan/dashboard/suratRekomendasi/{{$BadanUsaha->id}}">2. Surat Rekomendasi</a></span>
   <span><a href="/perbankan/dashboard/dataTambahan/{{$BadanUsaha->id}}" class="text-disetujuiTextColor">3. Data Tambahan</a></span>
</div>
<div class="bg-black w-[100%] h-[1px] mt-2"></div>
<br>

<h1>KTP</h1>
<img class="imgSlide h-[300]" src="{{$baseUrl.'/'.$dataPendukung->ktp}}" alt="img">
<h1>KK</h1>
<img class="imgSlide h-[300]" src="{{$baseUrl.'/'.$dataPendukung->kk}}" alt="img">


@endsection