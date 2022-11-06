@extends('layouts.ojk')
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
    'MEREK USAHA',
    'CABANG INDUSTRI',
    'SUB CABANG INDUSTRI',
    'KBLI',
    'INVESTASI/ MODAL ',
    'JUMLAH TENAGA KERJA PRIA',
    'JUMLAH TENAGA KERJA WANITA',
    'RATA RATA PENDIDIKAN TENAGA KERJA',
    'KAPASITAS PRODUKSI ',
    'SATUAN PRODUKSI',
    'NILAI PRODUKSI (RP.000)',
    'NILAI BAHAN BAKU (RP.000)',
    'LATITUDE',
    'LONGITUDE',
    'MEDIA SOSIAL',
    'FOTO ALAT PRODUKSI',
    'FOTO RUANG PRODUKSI',
    'PRODUK',
    'FILE DOKUMEN BENTUK USAHA',
    'FILE DOKUMEN NIB',
    'FILE SERTIFIKAT HALAL',
    'FILE SERTIFIKAT MEREK',
    'FILE SERTIFIKAT SNI',
];
?>
@section('content')
<div>
    <h2>Profil Badan Usaha</h2>
    <span class="mr-2"><a href="/ojk/dashboard/ProfilBadanUsaha/{{$BadanUsaha->id}}" class="text-disetujuiTextColor">1. Profil Badan Usaha</a></span>
    <span><a href="/ojk/dashboard/suratRekomendasi/{{$BadanUsaha->id}}">2. Surat Rekomendasi</a></span>
    <span><a href="/ojk/dashboard/dataTambahan/{{$BadanUsaha->id}}">3. Data Tambahan</a></span>
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

@elseif(
    $field == 'nib_file' ||
    $field == 'bentuk_usaha_file' ||
    $field == 'sertifikat_halal_file' ||
    $field == 'sertifikat_sni_file' ||
    $field == 'sertifikat_merek_file' 
    )
<div class="flex">
    <p  class="w-[400px]">{{$fieldTitles[$key]}}</p>
    <a target="_blank" href="{{$baseUrl.$BadanUsaha->$field}}">Lihat Dokumen</a>
</div>
@elseif(
    $field == 'foto_alat_produksi' || 
    $field == 'foto_ruang_produksi' ||
    $field == 'produk'
    )
<div>
    <h5>{{$fieldTitles[$key]}}</h5>
    <img class="h-[200px]" src="{{$baseUrl.$BadanUsaha->$field}}" alt="img">
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
        <p class="w-[300px]"><strong>{{number_format($BadanUsaha->$field,0)}}</strong></p>
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