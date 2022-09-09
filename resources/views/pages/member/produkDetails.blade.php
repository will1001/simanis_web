@extends('layouts.member')
<style>
    .actionContainer{
        width: 1000px;
    }
    .popUpContainer{
        width: 800px;
        height:600px
    }
    .imgSize{
        width:80px;
    }
</style>

@section('content')
<div class="flex justify-end items-center actionContainer">
    <!-- <div class="p-2 bg-white mr-2 rounded-xl cursor-pointer"><img src="{{ asset('/Icon-svg/notif.svg') }}"></div> -->
    <div class="flex p-2 bg-buttonColor-900 cursor-pointer text-white rounded-xl"><img class="mr-1" src="{{ asset('/Icon-svg/dana.svg') }}"> <span>Tambah Produk</span></div>
</div>
<div class="flex items-center actionContainer">
   <h5>Produk</h5>
</div>
<table class="actionContainer rounded-2xl">
  <tr class="bg-tableColor-900 text-center text-white p-2">
    <th class="text-center p-2 rounded-tl-xl">No</th>
    <th class="text-center p-2 ">Foto Poduk</th>
    <th class="text-center p-2 ">Nama</th>
    <th class="text-center p-2 ">Halal</th>
    <th class="text-center p-2 ">SNI</th>
    <th class="text-center p-2 ">Haki</th>
    <th class="text-center p-2 rounded-tr-xl">Deskripsi</th>
  </tr>
  <tr>
    <td class="text-center p-4 ">1</td>
    <td class="text-center p-1 imgSize"><img src="{{ asset('/img/produk1.png') }}" alt=""></td>
    <td class="text-center p-4 ">Sepatu Kain Tenun</td>
    <td class="text-center p-4 "><span class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">Ada</span></td>
    <td class="text-center p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Ada</span></td>
    <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Ada</span></td>
    <td class="text-center p-4 text-disetujuiTextColor cursor-pointer">Lihat Detail</td>
  </tr>
  <tr>
    <td class="text-center p-4 ">2</td>
    <td class="text-center p-1 imgSize"><img src="{{ asset('/img/produk2.png') }}" alt=""></td>
    <td class="text-center p-4 ">Sepatu Kain Tenun</td>
    <td class="text-center p-4 "><span class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">-</span></td>
    <td class="text-center p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">-</span></td>
    <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Ada</span></td>
    <td class="text-center p-4 text-disetujuiTextColor cursor-pointer">Lihat Detail</td>
  </tr>
  <tr>
    <td class="text-center p-4 ">3</td>
    <td class="text-center p-1 imgSize"><img src="{{ asset('/img/produk3.png') }}" alt=""></td>
    <td class="text-center p-4 ">Sepatu Kain Tenun</td>
    <td class="text-center p-4 "><span class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">-</span></td>
    <td class="text-center p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">-</span></td>
    <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">-</span></td>
    <td class="text-center p-4 text-disetujuiTextColor cursor-pointer">Lihat Detail</td>
  </tr>
  <tr>
    <td class="text-center p-4 ">4</td>
    <td class="text-center p-1 imgSize"><img src="{{ asset('/img/produk4.png') }}" alt=""></td>
    <td class="text-center p-4 ">Sepatu Kain Tenun</td>
    <td class="text-center p-4 "><span class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">Ada</span></td>
    <td class="text-center p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">-</span></td>
    <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">-</span></td>
    <td class="text-center p-4 text-disetujuiTextColor cursor-pointer">Lihat Detail</td>
  </tr>
 
 
 
</table>


<a href="{{ url('/member/produk') }}" class="bg-black opacity-40 w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
  </a>
<div class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 flex">
<img class="h-64" src="{{ asset('/img/produk1.png') }}" alt="">
<div class="p-4">
    <h3>Sepatu Kain Tenun</h3>
    <div class="mt-3 mb-3 flex justify-between items-center mr-7"><span>Sertifikat Halal</span> <span class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">Ada</span></div>
    <div class="mt-3 mb-3 flex justify-between items-center mr-7"><span>Sertifikat HAKI</span> <span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Ada</span></div>
    <div class="mt-3 mb-3 flex justify-between items-center mr-7"><span>Sertifikat SNI</span> <span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Ada</span></div>
    <h5>Deskripsi Produk</h5>
    <p>Sepatu etnik kain tenun bali
Tampil gaya, trendy dengan produk yang dibuat dengan bahan yg nyaman dipakai.
Sepatu kain tenun bali tersedia berbagai motif dan warna,
bahan kain tenun jepara dilapis spon 2 mm + merymesh
Outsole : PPC
uk 37 s/d 40
keterangan ukuran :
uk 37 = 24 cm
uk 38 = 24.5 cm
uk 39 = 25 cm
uk 40 = 26 cm

sebelum pesan mohon di tanyakan dulu motif dan warna di karenakan motif selalu berubah</p>
<div class="flex justify-end items-center mt-5">
      <div class="flex pl-16 pr-16 pt-2 pb-2 bg-buttonColor-900 cursor-pointer text-white rounded-xl font-bold text-xl"><span>Ok</span></div>
   </div>
</div>
</div>

@endsection