@extends('layouts.perbankan')
@section('content')
<div>
    <h2>Surat Rekomendasi</h2>
    <span class="mr-2"><a href="/perbankan/dashboard/ProfilBadanUsaha/{{$BadanUsaha->id}}">1. Profil Badan Usaha</a></span>
    <span><a class="text-disetujuiTextColor" href="/perbankan/dashboard/suratRekomendasi/{{$BadanUsaha->id}}">2. Surat Rekomendasi</a></span>
    <!-- <span><a href="/perbankan/dashboard/dataTambahan/{{$BadanUsaha->id}}">3. Data Tambahan</a></span> -->
</div>
<div class="bg-black w-[100%] h-[1px] mt-2"></div>
<br>
@php
$kopTanggal=date("d",strtotime($PengajuanDana->updated_at));
$kopBulan=date("m",strtotime($PengajuanDana->updated_at));
$kopTahun=date("Y",strtotime($PengajuanDana->updated_at));

$kopBulanRomawi;

if($kopBulan == 1) $kopBulanRomawi = "I";
if($kopBulan == 2) $kopBulanRomawi = "II";
if($kopBulan == 3) $kopBulanRomawi = "III";
if($kopBulan == 4) $kopBulanRomawi = "IV";
if($kopBulan == 5) $kopBulanRomawi = "V";
if($kopBulan == 6) $kopBulanRomawi = "VI";
if($kopBulan == 7) $kopBulanRomawi = "VII";
if($kopBulan == 8) $kopBulanRomawi = "VIII";
if($kopBulan == 9) $kopBulanRomawi = "IX";
if($kopBulan == 10) $kopBulanRomawi = "X";
if($kopBulan == 11) $kopBulanRomawi = "XI";
if($kopBulan == 12) $kopBulanRomawi = "XII";
@endphp
<div>
    <div>
        <form action="/perbankan/surat/downloadSurat/{{$BadanUsaha->id}}" method="get">
            <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download</button>
        </form>
    </div>
    <br>
    <br>
    <div id="surat">
        <div class="flex justify-center mb-4">
            <img class="mr-[70px] h-[84px]" src="{{ asset('/images/Logo NTB 1.png') }}" />
            <div class="text-center flex flex-col justify-center">
                <span class="font-bold text-black w-[320px]">{{$Surat->judul_kop}}</span>
                <!-- <span class="font-bold text-black">Dinas Pawriwisata Dan Kebudayaan</span> -->
                <!-- <span>Jl. Langko No.70, Pejeruk, Kec. Ampenan, Kota Mataram,</span>
                <span>Nusa Tenggara Bar. 83114</span> -->
                <span class="w-[320px]">{{$Surat->alamat_kop}}</span>
            </div>
            <img class="ml-[70px] h-[84px]" src="{{ asset('/images/NTB Gemilang Logo 1.png') }}" />
        </div>
        <div class="h-[4px] bg-black w-full mb-1"></div>
        <div class="h-[2px] bg-black w-full mb-2"></div>
        <div class="flex justify-center">
            <div class="text-center flex flex-col">
                <span class="font-bold text-black">SURAT REKOMENDASI</span>
                <span>Nomor : {{$Surat->nomor_surat}}/{{$kopBulan.$kopTanggal}}/01.IND/{{$kopBulanRomawi}}/{{$kopTahun}} </span>
            </div>
        </div>

        <div class="flex justify-start mt-[20px]">
            <div class="text-left flex flex-col">
                <span>Yang bertanda tangan dibawah ini :</span>
                <div class="flex ml-10 ">
                    <div class="flex flex-col mr-7">
                        <span>Nama</span>
                        <span>NIP</span>
                        <span>Jabatan</span>
                        <span>Alamat</span>
                    </div>
                    <div class="flex flex-col">
                        <span>: {{$Surat->nama_kadis}}</span>
                        <span>: {{$Surat->nip}}</span>
                        <span>: {{$Surat->jabatan}}</span>
                        <span>: {{$Surat->alamat}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-start mt-[20px]">
            <div class="text-left flex flex-col">
                <span>Dengan ini menerangkan bahwa IKM :</span>
                <div class="flex ml-10 ">
                    <div class="flex flex-col mr-7">
                        <span>Nama</span>
                        <span>Alamat</span>
                        <span>Nama Pemilik</span>
                        <span>No. Telepon</span>
                    </div>
                    <div class="flex flex-col">
                        <span>: {{$BadanUsaha->nama_usaha}}</span>
                        <span>: {{$BadanUsaha->alamat_lengkap}}</span>
                        <span>: {{$BadanUsaha->nama_direktur}}</span>
                        <span>: {{$BadanUsaha->no_hp}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-start mt-[50px]">
            <div class="text-left flex flex-col">
                <span class="w-[700px]">Adalah IKM Binaan Dinas Perindustrian Provinsi NTB dan telah memenuhi persyaratan untuk mengajukan pembiayaan kepada PT {{$PengajuanDana->nama}}</span>
                <span class="mt-[20px]">Demikian surat ini dibuat untuk digunakan sebagaimana mestinya</span>
            </div>
        </div>
        <div class="flex justify-end mt-[50px]">
            <div class="text-left flex flex-col">
                <span>Mataram, {{date('d-m-Y', strtotime($PengajuanDana->updated_at))}} </span>
                <span>Kepala Dinas Perindustrian <br> Provinsi Nusa Tenggara Barat</span>
                <img class="h-[60px]" src="{{ asset($Surat->ttd) }}">
                <span class="font-bold text-black">{{$Surat->nama_kadis}}</span>
                <span>{{$Surat->nip}}</span>
            </div>
        </div>
    </div>

    @endsection