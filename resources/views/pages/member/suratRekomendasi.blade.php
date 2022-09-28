@extends('layouts.member')
@section('content')
@if($PengajuanDana)
{{$PengajuanDana->updated_at}}
@php
$kopBulan=date("m",strtotime($PengajuanDana->updated_at));
$kopTahun=date("Y",strtotime($PengajuanDana->updated_at));
@endphp
<div >
    <div>
        <form action="{{ url('/member/downloadSurat') }}" method="get">
            <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download</button>
        </form>
    </div>
    <br>
    <br>
    <div id="surat">
        <div class="flex justify-center mb-4">
            <img class="mr-4 h-[84px]" src="{{ asset('/images/Logo NTB 1.png') }}" />
            <div class="text-center flex flex-col">
                <span class="font-bold text-black">Pemerintah Provinsi Nusa Tenggara Barat</span>
                <span class="font-bold text-black">Dinas Pawriwisata Dan Kebudayaan</span>
                <span>Jl. Langko No.70, Pejeruk, Kec. Ampenan, Kota Mataram,</span>
                <span>Nusa Tenggara Bar. 83114</span>
            </div>
            <img class="ml-4 h-[84px]" src="{{ asset('/images/NTB Gemilang Logo 1.png') }}" />
        </div>
        <div class="h-[4px] bg-black w-full mb-1"></div>
        <div class="h-[2px] bg-black w-full mb-2"></div>
        <div class="flex justify-center">
            <div class="text-center flex flex-col">
                <span class="font-bold text-black">SURAT REKOMENDASI</span>
                <span>Nomor : 1726/DPK-NTB/{{$kopBulan}}/{{$kopTahun}}/</span>
            </div>
        </div>

        <div class="flex justify-start mt-[50px]">
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
        <div class="flex justify-start mt-[100px]">
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
                        <span>: {{$BadanUsaha[0]->nama_usaha}}</span>
                        <span>: {{$BadanUsaha[0]->alamat_lengkap}}</span>
                        <span>: {{$BadanUsaha[0]->nama_direktur}}</span>
                        <span>: {{$BadanUsaha[0]->no_hp}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-start mt-[50px]">
            <div class="text-left flex flex-col">
                <span class="w-[700px]">Adalah IKM Binaan DInas Perindustrian PRovinsi NTB dan telah memenuhi persyaratan untuk mengajukan pinjaman kepada PT Bank</span>
                <span class="mt-[20px]">Demikian surat ini dibuat untuk digunakan sebagaimana mestinya</span>       
            </div>
        </div>
        <div class="flex justify-end mt-[150px]">
            <div class="text-left flex flex-col">
                <span>Mataram, {{date('d-m-Y', strtotime($PengajuanDana->updated_at))}} </span>
                <span>Kepala Dinas Perindustrian <br> Provinsi Nusa Tenggara Barat</span>
                <img src="{{ asset('/images/signKadis.png') }}">
                <span class="font-bold text-black">{{$Surat->nama_kadis}}</span>
                <span>{{$Surat->nip}}</span>
        </div>
    </div>
</div>

<!-- <div class="p-[100px]">
    <button onclick="printSurat()" class="rounded-xl px-4 py-2 bg-blue-500 text-white">Print</button>
    <button class="rounded-xl px-4 py-2 bg-blue-500 text-white">Download PDF</button>
</div> -->
@else
    <div>
        <h1>Belum Ada Surat Rekomendasi</h1>
    </div>
@endif

@endsection
