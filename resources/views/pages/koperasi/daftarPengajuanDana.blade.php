@extends('layouts.koperasi')
<style>
    .badan_usaha_container {
        width: 990px;
        height:80px;
    }
    p,
    .btn {
        margin: 20px 0;
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
        border-style: solid;
        border-color: red;
    }
    .iconSize {
        width: 11.67px;
        height: 5.83px;
    }

</style>
@section('content')
<h2 class="ml-4">Daftar Pengajuan Dana</h2>

<div class="flex flex-row badan_usaha_container ml-4 mt-4">
    <div class="flex gap-2 boxCari border rounded-md shadow-md bg-white">
        <img src="{{ asset('/icon svg/medium.svg') }}" alt="icon" class="flex h-8 w-8 ml-2 my-auto">
        <input type="text" placeholder="Cari Badan Usaha" class="my-auto panjangInput ml-1 placeholder:text-sm">
    </div>
    <div class="flex boxStat border rounded-md shadow-md ml-3 cursor-pointer whitespace-nowrap bg-white">
        <label for="role" class="flex text-slate-800 text-sm font-bold my-auto ml-3 h-[17px]  ">Semua Status</label>
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
    <div class="flex border borderM boxKab rounded-lg cursor-pointer ml1">       
            <input type="button" value="Hapus Pengajuan" class="text-ditolakTextColor text-sm font-bold my-auto mx-auto">
            <img src="{{ asset('/icon svg/sampahMerah.svg') }}" alt="role" class="flex my-auto mx-auto">       
    </div>
</div>

<table class="badan_usaha_container ml-4 bg-white mt-3 h-20"> 
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
  @foreach($PengajuanDana as $key=>$item)
    @php
        $statusClass = '';
        if($item->status == "Menunggu"){
        $statusClass = 'bg-menungguBgColor text-menungguTextColor';
        }
        if($item->status == "Ditolak"){
            $statusClass = 'bg-ditolakBgColor text-ditolakTextColor';
        }
        if($item->status == "Diterima"){
            $statusClass = 'bg-disetujuiBgColor text-disetujuiTextColor';
        }
    @endphp
  <tr class="bg-white h-14 gap-2">
  <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">1</td>
    <td class="text-left text-slate-700 font-bold p-2 ">{{$item->nama_usaha}}</td>
    <td class="text-left "><span class="flex text-left my-auto ml-5 w-[120px]">{{$item->kabupaten}}</span></td>
    <td class="text-left text-slate-700 font-bold"><span class="flex justify-center gap-1 my-auto ">{{$item->jumlah_dana}}</span></td>
    <td class="text-center p-2">{{$item->created_at}}</td>
    <td class="text-left p-2"><span class={{$statusClass}} p-2 rounded-xl">{{$item->status}}</span></td>
    <td class="text-center p-2  cursor-pointer">
        <div class="flex ml-2 gap-1 justify-start">
            <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
            <span class="bg-disetujuiTextColor text-white p-2 rounded-xl flex h-[36px] w-[37px]"><img src="{{ asset('/icon svg/ceklist.svg') }}" alt="icon"></span>
            <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
        </div>
    </td>
  </tr>
  @endforeach
 
</table>
 
<div class="flex badan_usaha_container bg-white ml-4 justify-between">
    <div class="flex ml-4 my-auto">
        <div class="flex bg-white rounded-lg shadow-md w-48 h-9 border-slate-200" >
          <div class="flex border px-3 rounded-md">
            <label for="role" class="text-slate-400 text-sm my-auto ">10</label>
            <button class=""></button>
            <img src="{{ asset('/icon svg/panahbawah.svg') }}" alt="role" class="my-auto ml-1 cursor-pointer">             
          </div>
            <span class="text-slate-400 text-sm my-auto ml-4">showing 1 - 10 of 85</span>                                    
        </div>
    </div>
     
    <div class="flex items-end my-auto mr-4">  
        <div class="flex gap-3 mx-3 my-auto"> 
          <button><img src="{{ asset('/icon svg/previous.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/icon svg/back.svg') }}" alt="icon"></button>
        </div> 
        <div class="flex mx-3">
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