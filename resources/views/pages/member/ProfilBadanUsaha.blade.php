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
    'FILE DOKUMEN',
    'TAHUN BERDIRI',    
    'NIB/TAHUN',
    'FILE DOKUMEN',
    'NOMOR SERTIFIKAT HALAL/ TAHUN',
    'FILE DOKUMEN',
    'SERTIFIKAT MEREK/TAHUN',
    'FILE DOKUMEN',
    'NOMOR TEST REPORT/TAHUN',
    'SNI/TAHUN',
    'FILE DOKUMEN',
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
    'FILE DOKUMEN BENTUK USAHA',
    'FILE DOKUMEN NIB',
    'FILE SERTIFIKAT HALAL',
    'FILE SERTIFIKAT MEREK',
    'FILE SERTIFIKAT SNI',
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
@elseif(
    $field == 'nib_file' ||
    $field == 'bentuk_usaha_file' ||
    $field == 'sertifikat_halal_file' ||
    $field == 'sertifikat_sni_file' ||
    $field == 'sertifikat_merek_file' 
    )
<div class="flex">
    <p  class="w-[400px]">{{$fieldTitles[$key]}}</p>
    <a target="_blank" href="{{$baseUrl.$BadanUsaha[0]->$field}}">Lihat Dokumen</a>
</div>
@elseif(
    $field == 'foto_alat_produksi' || 
    $field == 'foto_ruang_produksi'
    )
<div>
    <h5>{{$fieldTitles[$key]}}</h5>
    <img src="{{$baseUrl.$BadanUsaha[0]->$field}}" alt="img">
</div>
@elseif(
    $field == 'investasi_modal' || 
    $field == 'jumlah_tenaga_kerja_pria' || 
    $field == 'jumlah_tenaga_kerja_wanita' || 
    $field == 'kapasitas_produksi_perbulan' || 
    $field == 'nilai_produksi_perbulan' || 
    $field == 'nilai_bahan_baku_perbulan'
    )
    <div class="flex justify-start text-textColor2">
        <p class="w-[400px]">{{$fieldTitles[$key]}}</p>
        <p class="w-[10px]">:</p>
        <p class="w-[300px]"><strong>{{number_format($BadanUsaha[0]->$field,0)}}</strong></p>
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