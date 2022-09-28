@extends('layouts.member')
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
    'INVESTASI/ MODAL (RP. 000)',
    'JUMLAH TENAGA KERJA PRIA',
    'JUMLAH TENAGA KERJA WANITA',
    'KAPASITAS PRODUKSI (RP. 000)',
    'SATUAN PRODUKSI',
    'NILAI PRODUKSI (RP.000)',
    'NILAI BAHAN BAKU (RP.000)',
    'LATITUDE',
    'LONGITUDE',
    'MEDIA SOSIAL',
    'FOTO ALAT PRODUKSI',
    'FOTO RUANG PRODUKSI',
];
?>
@section('content')
<h1>Profil Badan Usaha</h1>
<form method="GET" action="/form/member/{{$BadanUsaha[0]->id}}" style="margin-right:10px">
    <button type="submit" class="rounded-lg text-white bg-blue-500 p-2">Edit Profil</button>
</form>
@foreach($fields as $key => $field)
@if($field == 'id')
<span></span>
@elseif($field == 'foto_alat_produksi' || $field == 'foto_ruang_produksi')
<div>
    <h5>{{$fieldTitles[$key]}}</h5>
    <img src="{{$baseUrl.$BadanUsaha[0]->$field}}" alt="img">
</div>
@else
<div class="flex justify-start text-textColor2">
<p class="w-[400px]">{{$fieldTitles[$key]}}</p>
<p class="w-[10px]">:</p>
<p class="w-[300px]"><strong>{{$BadanUsaha[0]->$field}}</strong></p>

</div>
@endif
@endforeach

@endsection