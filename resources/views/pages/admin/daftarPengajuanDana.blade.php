@extends('layouts.admin')
<style>
    <style>
    .actionContainer{
        width: 990px;
        height:80px;
    }
    .boxCari {
        width: 206px;
        height: 48px;
    }
    .boxKab {
        width: 192px;
        height: 48px;
    }
    .boxKal {
        width: 52px;
        height: 48px;
    }
    .boxStat {
        width: 160px;
        height: 48px;
    }
    .panjangInput {
        width: 146px;
        height: 18px;
    }
    .ml1 {
        margin-left: 145px;
    }
    .borderM {
        border: bottom radius 0.5rem;
    }
    .iconSize {
        width: 11.67px;
        height: 5.83px;
    }
    .bg {
      width: 100%;
      height: 900px;
      z-index: -10;
    }
</style>
@section('content')


<div class="bg bg-slate-150 absolute"></div>
<h3 class="ml-4">Daftar Pengajuan Dana</h3>


<div class="flex flex-row actinContainer ml-4 mt-4">
    <div class="flex gap-2 boxCari border rounded-md shadow-md bg-white">
        <img src="{{ asset('/icon svg/medium.svg') }}" alt="icon" class="flex h-8 w-8 ml-2 my-auto">
        <input type="text" placeholder="Cari Badan Usaha" class="my-auto panjangInput ml-1 placeholder:text-sm">
    </div>
    <div class="flex boxStat border rounded-md shadow-md ml-3 cursor-pointer bg-white">
        <label for="role" class="flex panjangInput text-slate-800 text-sm font-bold my-auto ml-3 h-[17px] whitespace-nowrap ">Semua Status</label>
        <input type="radio" id="role" name="role" class="hidden">
        <img src="{{ asset('/icon svg/icon.svg') }}" alt="role" class="flex mx-3 my-auto ">
    </div>
    <div class="flex border rounded-md shadow-md ml-3 cursor-pointer boxKab whitespace-nowrap bg-white ">
        <label for="role" class=" text-slate-800 text-sm font-bold my-auto ml-5 h-[17px] ">Semua Kab/Kota</label>
        <input type="radio" id="role" name="role" class="hidden">
        <img src="{{ asset('/icon svg/icon.svg') }}" alt="role" class="flex mx-auto my-auto">
    </div>   
    <div class="flex border rounded-md shadow-md ml-3 cursor-pointer boxKal bg-white">
        <img src="{{ asset('/icon svg/iconDate.svg') }}" alt="icon" class="flex my-auto mx-auto">
    </div>
    <div class="flex border boxKab rounded-lg cursor-pointer ml1 bg-ditolakTextColor">       
            <input type="button" value="Hapus Pengajuan" class="text-white text-sm font-bold my-auto ml-5 h-[20px]">
            <img src="{{ asset('/icon svg/sampahPutih.svg') }}" alt="role" class="flex my-auto mx-auto ">       
    </div>
</div>

    
  </div>

  <div class="flex flex-col actionContainer ml-4  mt-3 h-14">
    <table class="badan_usaha_container ml-4 bg-white mt-3 h-20 shadow-lg"> 
    <tr class="bg-tableColor-900 text-white text-center h-16 gap-3">
     <th class="cursor-pointer text-center pl-2 rounded-tl-xl"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
     <th class="text-center p-2">No</th>
     <th class="text-left p-2 ">Badan Usaha</th>
     <th class="text-left ">
        <div class="flex text-left gap-1 my-auto ml-5  "><img src="{{ asset('/icon svg/iconBawahAtas.svg') }}" alt="" class="flex"> Kabupaten</div>
     </th>     
     <th class="text-left">
        <div class="flex justify-center gap-1 my-auto "><img src="{{ asset('/icon svg/iconBawahAtas.svg') }}" alt="" class="flex"> Jumlah Dana</div>
     </th>              
      <th class="text-left p-2 "><span class="flex justify-center my-auto mx-6">Tanggal</span></th>   
      <th class="text-left p-2 "><span class="">Status</span></th>   
      <th class="rounded-tr-xl">Aksi</span></th>   
    </tr>
    <tr class="bg-white h-14 gap-2">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">1</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Bangun Jaya Alam, </br>PT</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]"> Kota Bima</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-ditolakBgColor text-ditolakTextColor p-2 rounded-xl">Ditolak</span></td>
    <td class="text-center p-2  cursor-pointer">
        <div class="flex ml-2 gap-1 justify-start">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    <tr class="bg-slate-50 h-14 gap-2">
    <td class=" cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">2</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Cakradenta Agung, </br>PT</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]"> Kota Mataram</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
    <td class="text-center p-2">
        <div class="flex ml-2 gap-1 justify-start  cursor-pointer">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    <tr class="bg-white h-14 gap-2">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">3</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Cakung Permata, </br>Nusa PT</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">Kab Bima</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
    <td class="text-center p-2">
        <div class="flex ml-2 gap-1 justify-start  cursor-pointer">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    <tr class="bg-slate-50 h-14 gap-2">
   <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">4</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Calista Alam, PT</br></td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">Kab Bima</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
    <td class="text-center p-2">
        <div class="flex ml-2 gap-1 justify-start cursor-pointer">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    <tr class="bg-white h-14 gap-2">
   <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">5</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Cibaliung Tunggal,</br>Nusa PT</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">Kab Dompu</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
    <td class="text-center p-2">
        <div class="flex ml-2 gap-1 justify-start cursor-pointer">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    <tr class="bg-slate-50 h-14 gap-2">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">6</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Comismas</br>Wanamaja, PT</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">Kab Lombok Barat</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
    <td class="text-center p-2">
        <div class="flex ml-2 gap-1 justify-start cursor-pointer">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    <tr class="bg-white h-14 gap-2">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">7</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Bangun Nusa Indah,</br>PT</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">Kab Lombok Tengah</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
    <td class="text-center p-2">
        <div class="flex ml-2 gap-1 justify-start cursor-pointer">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    <tr class="bg-slate-50 h-14 gap-2">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">8</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Agro Indah</br>Sembada, PT</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">Kab Lombok Timur</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-menungguBgColor text-menungguTextColor p-2 rounded-xl">Menunggu</span></td>
    <td class="text-center p-2">
        <div class="flex ml-2 gap-1 justify-start cursor-pointer">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    <tr class="bg-white h-14 gap-2">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">9</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Agro Teknika</br> Pratama, PT</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">Kab Lombok Utara</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Disetujui</span></td>
    <td class="text-center p-2">
        <div class="flex ml-2 gap-1 justify-start cursor-pointer">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    <tr class="bg-slate-50 h-14 gap-2">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">10</td>
    <td class="text-left text-slate-700 font-bold p-2 ">Agrodesa Palmaindo,</br> PT</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">Kab Sumbawa Barat</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">Rp 200.000.000</span></td>
    <td class="text-center p-2">14/08/2022</td>
    <td class="text-left p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Disetujui</span></td>
    <td class="text-center p-2">
        <div class="flex ml-2 gap-1 justify-start cursor-pointer">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
    </tr>
    </table>

    <div class="flex actionContainer bg-white justify-between shadow-lg ml-4">
      <div class="flex  actionContainer ml-4 my-4">
        <div class="flex bg-white rounded-lg mt-4 shadow-md w-48 h-9 border-slate-200" >
          <div class="flex border px-3 rounded-md">
            <label for="role" class="text-slate-400 text-sm my-auto ">10</label>
            <button class=""></button>
            <img src="{{ asset('/icon svg/panahbawah.svg') }}" alt="role" class="my-auto ml-1 cursor-pointer">             
          </div>
            <span class="text-slate-400 text-sm my-auto ml-4">showing 1 - 10 of 85</span>                                    
        </div>
    </div>
     
    <div class="flex actionContainer items-end mt-4 mr-4">  
        <div class="flex gap-3 my-auto"> 
          <button><img src="{{ asset('/icon svg/previous.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/icon svg/back.svg') }}" alt="icon"></button>
        </div> 
        <div class="flex mx-3 my-auto">
          <button><span class="bg-blue-200 text-disetujuiTextColor py-1 px-3 rounded-md">1</span></button>        
          <button><span class="py-1 px-3 rounded-md">2</span></button>
          <button><span class="py-1 px-3 rounded-md">3</span></button>
          <button><span class="py-1 px-3 rounded-md">4</span></button>
        </div>
        <div class="flex gap-3 my-auto">
          <button><img src="{{ asset('/icon svg/next.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/icon svg/skip.svg') }}" alt="icon"></button>
        </div>
    </div>

  </div>


   


  @endsection