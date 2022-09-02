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
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>

@section('content')
<div class="flex justify-end items-center actionContainer">
    <!-- <div class="p-2 bg-white mr-2 rounded-xl cursor-pointer"><img src="{{ asset('/icon svg/notif.svg') }}"></div> -->
    <div onclick="openForm()" class="flex p-2 bg-buttonColor-900 cursor-pointer text-white rounded-xl"><img class="mr-1" src="{{ asset('/icon svg/dana.svg') }}"> <span>Tambah Produk</span></div>
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
  @php
    $index = 0;
  @endphp
  @foreach($Produk as $key=>$item)

 

  <tr>
    <td class="text-center p-4 ">{{++$key}}</td>
    <td class="text-center p-1 imgSize"><img src="{{ asset('/img/produk1.png') }}" alt=""></td>
    <td class="text-center p-4 ">{{$item->nama}}</td>
    <td class="text-center p-4 "><span class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">{{is_null($item->sertifikat_halal)?"Tidak Ada":"Ada"}}</span></td>
    <td class="text-center p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">{{is_null($item->sertifikat_haki)?"Tidak Ada":"Ada"}}</span></td>
    <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">{{is_null($item->sertifikat_sni)?"Tidak Ada":"Ada"}}</span></td>
    <td onclick="lihatDetails({{$index++}})"  class="text-center p-4 text-disetujuiTextColor cursor-pointer">Lihat Detail</td>
  </tr>
  @endforeach

 
 
</table>


<div onclick="closeDetails()" style="visibility: collapse;" id="PopUpBlackbg" class="bg-black opacity-40 w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30">
</div>

<div style="visibility: collapse;" id="detailPopUp" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 flex">
  <img class="h-64" src="{{ asset('/img/produk1.png') }}" alt="">
  <div class="p-4">
      <h3 id="nama">Sepatu Kain Tenun</h3>
      <div class="mt-3 mb-3 flex justify-between items-center mr-7"><span>Sertifikat Halal</span> <span id="sertifikat_halal"  class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">Ada</span></div>
      <div  class="mt-3 mb-3 flex justify-between items-center mr-7"><span>Sertifikat HAKI</span> <span id="sertifikat_sni" class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Ada</span></div>
      <div  class="mt-3 mb-3 flex justify-between items-center mr-7"><span>Sertifikat SNI</span> <span id="sertifikat_haki" class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Ada</span></div>
      <h5 >Deskripsi Produk</h5>
      <p id="deskripsi"></p>
    <div  onclick="closeDetails()" class="flex justify-end items-center mt-5 cursor-pointer">
          <div class="flex pl-16 pr-16 pt-2 pb-2 bg-buttonColor-900 cursor-pointer text-white rounded-xl font-bold text-xl"><span>Ok</span></div>
    </div>
  </div>
</div>

<div style="visibility: collapse;" id="formPopUp" class="bg-white rounded-xl popUpContainer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50 p-3">
<h1>Ajukan Produk</h1>
<br>
<form action="{{url('ajukan_produk')}}" method="post">
@csrf
<div>
  <span>Nama Produk</span>
  <input class="border-2 border-black"type="text" name="nama">
</div>
<br>
<div>
  <span>Sertifikat Halal</span>
  <br>
  <span>Tahun Sertifikat</span>
   : <input class="border-2 border-black"type="number" name="sertifikat_halal_thn">
  <span>Nomor Sertifikat</span>
   : <input class="border-2 border-black"type="text" name="sertifikat_halal_no">
</div>
<div>
  <span>Sertifikat Haki</span>
 <br>
  <span>Tahun Sertifikat</span>
   : <input class="border-2 border-black"type="number" name="sertifikat_haki_thn">
  <span>Nomor Sertifikat</span>
   : <input class="border-2 border-black"type="text" name="sertifikat_haki_no">
</div>
<div>
  <span>Sertifikat SNI</span>
 <br>
  <span>Tahun Sertifikat</span>
   : <input class="border-2 border-black"type="number" name="sertifikat_sni_thn">
  <span>Nomor Sertifikat</span>
   : <input class="border-2 border-black"type="text" name="sertifikat_sni_no">
</div>
<div class="flex items-center">
  <span>Deskripsi Produk</span>
  <textarea name="deskripsi" cols="30" rows="5"></textarea>
</div>
<div>
  <span>Upload Foto</span>
  <input type="file" name="foto">
</div>
<br>
<div>
  <div>cancel</div>
  <button>ajukan produk</button>

</div>
</form>

</div>

@endsection
<script>
  const produk = @json($Produk);

  const lihatDetails = (index)=>{
    console.log(produk);
    const blackBg = document.getElementById('PopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const nama = document.getElementById('nama');
    const sertifikat_halal = document.getElementById('sertifikat_halal');
    const sertifikat_sni = document.getElementById('sertifikat_sni');
    const sertifikat_haki = document.getElementById('sertifikat_haki');
    const deskripsi = document.getElementById('deskripsi');
    nama.innerHTML = produk[index].nama;
    sertifikat_halal.innerHTML = produk[index].sertifikat_halal;
    sertifikat_sni.innerHTML = produk[index].sertifikat_sni;
    sertifikat_haki.innerHTML = produk[index].sertifikat_haki;
    deskripsi.innerHTML = produk[index].deskripsi;
   


    blackBg.style.visibility = "visible";
    detailPopUp.style.visibility = "visible";
  }
  const closeDetails = ()=>{
    const blackBg = document.getElementById('PopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const formPopUp = document.getElementById('formPopUp');

    blackBg.style.visibility = "collapse";
    detailPopUp.style.visibility = "collapse";
    formPopUp.style.visibility = "collapse";

  }

  const openForm = ()=>{
    const blackBg = document.getElementById('PopUpBlackbg');
    const formPopUp = document.getElementById('formPopUp');
    blackBg.style.visibility = "visible";
    formPopUp.style.visibility = "visible";

  }
</script>