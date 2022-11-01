@extends('layouts.koperasi')
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
$fieldTitles = [
    'id',
    'NOMOR INDUK KEPENDUDUKAN (NIK)',
    'NAMA',
    'KAB/KOTA',
    'KECAMATAN',
    'KELURAHAN/DESA',
    'ALAMAT LENGKAP',
    'NO. HP',
    'NAMA USAHA',
    'BENTUK USAHA',
    'TAHUN BERDIRI',
    'LEGALITAS USAHA',
    'NIB/TAHUN',
    'NOMOR SERTIFIKAT HALAL/ TAHUN',
    'SERTIFIKAT MEREK/TAHUN',
    'NOMOR TEST REPORT/TAHUN',
    'SNI/TAHUN',
    'JENIS USAHA',
    'CABANG INDUSTRI',
    'SUB CABANG INDUSTRI',
    'KBLI',
    'INVESTASI/ MODAL ',
    'JUMLAH TENAGA KERJA PRIA',
    'JUMLAH TENAGA KERJA WANITA',
    'KAPASITAS PRODUKSI ',
    'SATUAN PRODUKSI',
    'NILAI PRODUKSI ',
    'NILAI BAHAN BAKU ',
    'LATITUDE',
    'LONGITUDE',
    'MEDIA SOSIAL',
    'FOTO ALAT PRODUKSI',
    'FOTO RUANG PRODUKSI',
];
?>
@section('content')
<div>
    <h2>Profil Badan Usaha</h2>
    <span class="mr-2"><a href="/koperasi/dashboard/ProfilBadanUsaha/{{$BadanUsaha->id}}" class="text-disetujuiTextColor">1. Profil Badan Usaha</a></span>
    <span><a href="/koperasi/dashboard/suratRekomendasi/{{$BadanUsaha->id}}">2. Surat Rekomendasi</a></span>
</div>
<div class="bg-black w-[100%] h-[1px] mt-2"></div>
<br>
<div>
    <form action="/export/badan_usaha/perbankan/{{$BadanUsaha->id}}" method="get">
        <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download</button>
    </form>
</div>

<br>
@foreach($fields as $key => $field)
@if($field == 'id')
<span></span>
@elseif($field == 'foto_alat_produksi' || $field == 'foto_ruang_produksi')
<div>
    <h5>{{$fieldTitles[$key]}}</h5>
    <img src="{{$baseUrl.$BadanUsaha->$field}}" alt="img">
</div>
@else
<div class="flex justify-start text-textColor2">
    <p class="w-[400px]">{{$fieldTitles[$key]}}</p>
    <p class="w-[10px]">:</p>
    <p class="w-[300px]"><strong>{{$BadanUsaha->$field}}</strong></p>
</div>
@endif
@endforeach

@endsection