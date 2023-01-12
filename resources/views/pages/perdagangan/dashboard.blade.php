@extends('layouts.perdagangan')
<style>
    .badan_usaha_container {
        width: 990px;
    },
    p,
    .btn {
        margin: 20px 0;
    }
    .boxIcon {
        width: 52px;
        height: 52px;
    }
    .boxProduk {
        width: 226px;
        height: 105px;
    }
    .boxNotif {
        width: 357px;
        height: 438px;
        margin-left:570px;
        filter: drop-shadow(0px 100px 80px rgba(0, 0, 0, 0.09)) drop-shadow(0px 41.7776px 33.4221px rgba(0, 0, 0, 0.0646969)) drop-shadow(0px 22.3363px 17.869px rgba(0, 0, 0, 0.0536497)) drop-shadow(0px 12.5216px 10.0172px rgba(0, 0, 0, 0.045)) drop-shadow(0px 6.6501px 5.32008px rgba(0, 0, 0, 0.0363503)) drop-shadow(0px 2.76726px 2.21381px rgba(0, 0, 0, 0.0253031));
    }
    .boxIsiNotif {
        width: 357px;
        height: 105px;
    }
    .warningColor {
        background-color: #F59E0B;
    }
    .bgTabel {
        background-color: #F3F4F6;
    }
    .hTabel {
        height: 72px;
    }
    .imgSize {
        width: 62px;
        height: 62px;
    }
    .bg {
      width: 100%;
      height: 900px;
      z-index: -10;
    }
</style>
@section('content')
<div class="bg bg-slate-150 absolute"></div>
<div class="flex justify-between badan_usaha_container">
    <h2 class="text-slate-800 ml-4">Dashboard</h2>
    <!-- <div class="boxNotif flex flex-col absolute bg-white rounded-lg justify-center">
        <span class="text-center text-2xl text-slate-800 font-bold my-auto">Notifikasi Anda</span>
        <div class="flex flex-row boxIsiNotif bg-disetujuiBgColor p-2 gap-3 border">
            <img class="ml-2" src="{{ asset('/Icon-svg/iconKeranjang.svg') }}" alt="iconKeranjang">
            <p class="my-auto text-sm text-slate-800"><span class="text-lg font-bold">Pengajuan Produk Diterima</span><br>
            <span class="font-bold">Produk Sepatu Kain Lokal</span> yang diajukan oleh<br>
            <span class="font-bold">IKN Tani Maju </span>telah disetujui <br>
            </p>
        </div>
        <div class="flex flex-row boxIsiNotif bg-disetujuiBgColor p-2 gap-3 border">
            <img class="ml-2" src="{{ asset('/Icon-svg/iconKeranjang.svg') }}" alt="iconKeranjang">
            <p class="my-auto text-sm text-slate-800"><span class="text-lg font-bold">Pengajuan Produk Diterima</span><br>
            <span class="font-bold">Produk Sepatu Kain Lokal</span> yang diajukan oleh<br>
            <span class="font-bold">IKN Tani Maju </span>telah disetujui <br>
            </p>
        </div>
        <div class="flex flex-row boxIsiNotif bg-disetujuiBgColor p-2 gap-3 border">
            <img class="ml-2" src="{{ asset('/Icon-svg/iconKeranjang.svg') }}" alt="iconKeranjang">
            <p class="my-auto text-sm text-slate-800"><span class="text-lg font-bold">Pengajuan Produk Diterima</span><br>
            <span class="font-bold">Produk Sepatu Kain Lokal</span> yang diajukan oleh<br>
            <span class="font-bold">IKN Tani Maju </span>telah disetujui <br>
            </p>
        </div>
        <span class="text-center text-md font-bold text-disetujuiTextColor my-auto cursor-pointer">Tandai Semua Telah Dibaca</span>
    </div>
    <div class="boxIcon bg-white px-3 py-3 rounded-md cursor-pointer">
        <img class="" src="{{ asset('/Icon-svg/iconNotif.svg') }}" alt="iconNotif">
    </div> -->
</div>

<!-- <div class="ml-4 my-5 flex justify-between badan_usaha_container">
    <div class="boxProduk flex flex-col bg-slate-200 border shadow-md px-3 py-3 rounded-md cursor-pointer">
        <span class="my-auto font-bold text-xl text-slate-800">248</span>
        <span class="text-slate-800 font-semibold">Pengajuan Produk</span>
    </div>
    <div class="boxProduk flex flex-col bg-disetujuiTextColor shadow-md px-3 py-3 rounded-md cursor-pointer">
        <span class="my-auto font-bold text-xl text-white">87</span>
        <span class="text-white font-semibold">Produk Diterima</span>
    </div>
    <div class="boxProduk flex flex-col bg-ditolakTextColor shadow-md px-3 py-3 rounded-md cursor-pointer">
        <span class="my-auto font-bold text-xl text-white">15</span>
        <span class="text-white font-semibold">Produk Ditolak</span>
    </div>
    <div class="boxProduk flex flex-col warningColor shadow-md px-3 py-3 rounded-md cursor-pointer">
        <span class="my-auto font-bold text-xl text-white">185</span>
        <span class="text-white font-semibold">Menunggu Respon</span>
    </div>
</div> -->

<div class="ml-4 mt-4 bg-white flex flex-col items-center badan_usaha_container rounded-2xl">
    <span class="badan_usaha_container  hTabel ml-5"><h5 class="mt-4">Produk Baru</h5></span>
        
    <table class="badan_usaha_container bg-disetujuiBgColor">
        <tr class="bgTabel text-center text-slate-800 p-2  hTabel">
            <th class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
            <th class="text-center p-2 ">No</th>
            <th class="text-center p-2 ">Foto Poduk</th>
            <th class="text-center p-2 ">Nama</th>
            <th class="text-center p-2 ">NIB</th>
            <th class="text-center p-2 ">Kapasitas Produksi</th>
            <!-- <th class="text-center p-2 ">Harga</th> -->
        </tr>
        @foreach($Produk as $key=>$item)

        <tr class=" hTabel bg-white">
            <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></td>
            <td class="text-center p-4 text-slate-800">{{++$key}}</td>
            <td class="text-center p-1 imgSize"><img class="mx-auto" src="{{ asset($item->foto) }}" alt=""></td>
            <td class="text-center p-4 text-slate-800">{{$item->nama}}</td>
            <td class="text-center p-4 text-slate-800">{{$item->nib_tahun}}</td>
            <td class="text-center p-4 text-slate-800">{{$item->kapasitas_produksi_perbulan}}/Bulan</td>
            <!-- <td class="text-center p-4 text-disetujuiTextColor ">{{$item->nama}}</td>     -->
        </tr>
        @endforeach

    </tabel>   
</div>
@endsection