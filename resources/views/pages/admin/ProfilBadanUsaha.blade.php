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
    'OMSET',
    'LATITUDE',
    'LONGITUDE',
    'MEDIA SOSIAL',
    'FOTO ALAT PRODUKSI',
    'FOTO RUANG PRODUKSI',
    'PRODUK',
    'KTP',
    'KK',
    'KTP PASANGAN',
    'FILE DOKUMEN BENTUK USAHA',
    'FILE DOKUMEN NIB',
    'FILE SERTIFIKAT HALAL',
    'FILE SERTIFIKAT MEREK',
    'FILE SERTIFIKAT SNI',
];
?>
@section('content')

<h1>Profil Badan Usaha</h1>
<div>
    <span class="mr-2"><a href="/admin/daftarPengajuanDana/ProfilBadanUsaha/{{$BadanUsaha->id}}" class="text-disetujuiTextColor">1. Profil Badan Usaha</a></span>
    <span><a href="/admin/daftarPengajuanDana/suratRekomendasi/{{$BadanUsaha->id}}">2. Surat Rekomendasi</a></span>
    <!-- <span><a href="/admin/daftarPengajuanDana/dataTambahan/{{$BadanUsaha->id}}">3. Data Tambahan</a></span> -->
</div>
<div class="bg-black w-[100%] h-[1px] mt-2"></div>
<br>

<div>
    <form action="/admin/daftarPengajuanDana/downloadProfilBadanUsaha/{{$BadanUsaha->id}}" method="get">
        <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download</button>
    </form>
</div>

<br>
@foreach($fields as $key => $field)
@if($field == 'id')
<span></span>
@elseif($field == 'foto_alat_produksi' ||
$field == 'foto_ruang_produksi' ||
$field == 'ktp_pasangan' ||
$field == 'kk' ||
$field == 'ktp' ||
$field == 'produk')
<div>
    <h5>{{$fieldTitles[$key]}}</h5>
    <img class="h-[300px]" src="{{$baseUrl.$BadanUsaha->$field}}" alt="img">
</div>
@elseif(
$field == 'nib_file' ||
$field == 'bentuk_usaha_file' ||
$field == 'sertifikat_halal_file' ||
$field == 'sertifikat_sni_file' ||
$field == 'sertifikat_merek_file'
)
<div class="flex">
    <p class="w-[400px]">{{$fieldTitles[$key]}}</p>
   
    @if(!empty($BadanUsaha[0]->$field))
        <a target="_blank" href="{{$baseUrl.$BadanUsaha[0]->$field}}">Lihat Dokumen</a>
    @endif
</div>
@elseif(
$field == 'investasi_modal' ||
$field == 'jumlah_tenaga_kerja_pria' ||
$field == 'jumlah_tenaga_kerja_wanita' ||
$field == 'kapasitas_produksi_perbulan' ||
$field == 'nilai_produksi_perbulan' ||
$field == 'nilai_bahan_baku_perbulan' ||
$field == 'omset' 
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

<h1>Kartu Member</h1>

<div class="flex bg-white rounded-xl p-4">
    <div>
        <h2>No Kartu. {{substr($BadanUsaha->nik,strlen($BadanUsaha->nik)-4,strlen($BadanUsaha->nik))}}{{$BadanUsaha->id_cabang_industri}}{{$BadanUsaha->id_kabupaten}}</h2>
        <div class="flex">
            <div>
                <div class="flex">
                    <div class="mr-10">Nama</div>
                </div>
                <div class="flex">
                    <div class="mr-10">Alamat</div>
                </div>
                <div class="flex">
                    <div class="mr-10">Usaha</div>
                </div>
                <div class="flex">
                    <div class="mr-10">Kabupaten</div>
                </div>
                <div class="flex">
                    <div class="mr-10">NIK</div>
                </div>
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
<div>
    <form action="{{ url('/admin/downloadKartu') }}" method="get">
        <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download</button>
    </form>
</div>

@endsection