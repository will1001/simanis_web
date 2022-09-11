@extends('layouts.member')
<style>
    .actionContainer{
        width: 1000px;
    }
    .popUpContainer{
        width: 900px;
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
    <!-- <div class="p-2 bg-white mr-2 rounded-xl cursor-pointer"><img src="{{ asset('/Icon-svg/notif.svg') }}"></div> -->
    <div onclick="openForm()" class="flex p-2 bg-buttonColor-900 cursor-pointer text-white rounded-xl"><img class="mr-1" src="{{ asset('/Icon-svg/dana-white.svg') }}"> <span>Tambah Produk</span></div>
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
    <td class="text-center p-1 imgSize"><img src="{{ asset($item->foto) }}" alt=""></td>
    <td class="text-center p-4 ">{{$item->nama}}</td>
    <td class="text-center p-4 "><span class="bg-halalBgColor text-halalTextColor p-2 rounded-xl">{{is_null($item->sertifikat_halal)?"Tidak Ada":"Ada"}}</span></td>
    <td class="text-center p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">{{is_null($item->sertifikat_haki)?"Tidak Ada":"Ada"}}</span></td>
    <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">{{is_null($item->sertifikat_sni)?"Tidak Ada":"Ada"}}</span></td>
    <td onclick="lihatDetails({{$index++}})"  class="text-center p-4 text-disetujuiTextColor cursor-pointer">Lihat Detail</td>
  </tr>
  @endforeach

 
 
</table>


@endsection
<script>
  const produk = @json($Produk);
  const baseUrl = "http://127.0.0.1:8000/";

  const lihatDetails = (index)=>{
    const blackBg = document.getElementById('PopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    const foto = document.getElementById('fotoProduk');
    const nama = document.getElementById('nama');
    const sertifikat_halal = document.getElementById('sertifikat_halal');
    const sertifikat_sni = document.getElementById('sertifikat_sni');
    const sertifikat_haki = document.getElementById('sertifikat_haki');
    const deskripsi = document.getElementById('deskripsi');
    foto.src = baseUrl + produk[index].foto;
    nama.innerHTML = produk[index].nama;
    sertifikat_halal.innerHTML = produk[index].sertifikat_halal ? "Ada" : "Tidak Ada";
    sertifikat_sni.innerHTML = produk[index].sertifikat_sni ? "Ada" : "Tidak Ada";
    sertifikat_haki.innerHTML = produk[index].sertifikat_haki ? "Ada" : "Tidak Ada";
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