@extends('layouts.admin')
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
@foreach($fields as $key => $field)
@if($field == 'id')
<span></span>
@elseif($field == 'foto_alat_produksi' || $field == 'foto_ruang_produksi')
<div>
    <h5>{{$fieldTitles[$key]}}</h5>
    <img src="{{$baseUrl.$BadanUsaha->$field}}" alt="img">
</div>
@else
<p>{{$fieldTitles[$key]}} : <strong>{{$BadanUsaha->$field}}</strong></p>
@endif
@endforeach

<h1>Kartu Member</h1>

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
    <img class="w-[200px] m-3" src="{{ asset($User->foto) }}" alt="">
</div>
<br>
<h5>Ganti Foto</h5>
<div>
        <form action="{{ url('/admin/downloadKartu') }}" method="get">
            <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download</button>
        </form>
    </div>

@endsection