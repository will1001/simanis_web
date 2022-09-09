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
    .wNIK {
        width: 407px;
    }
    .wRole {
        width: 109px;
    }
    .wStatus {
        width: 160px;
    }
    .wAksi {
        width: 157px;
    }
    .hFooter {
        height: 100px;
    }
    .hTabel {
        height: 72px;
    }
</style>
@section('content')

<h2 class="ml-4">Daftar Akun IKN</h2>

<table class="badan_usaha_container ml-4 bg-white mt-3"> 
  <tr class="bg-tableColor-900 text-white text-center hTabel  gap-3">
    <th class="cursor-pointer text-center pl-2 rounded-tl-xl"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <th class="text-center p-2">No</th>
    <th class="text-left p-2 wNIK">NIK</th>
    <th class="text-left p-2 wRole">Role</th>     
    <th class="text-center p-2 wStatus">Status</th>     
    <th class="text-center p-2 wAksi rounded-tr-xl">Aksi</span></th>   
  </tr>
  <tr class="bg-white h-14 gap-2 hTabel">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
        <td class="text-center text-slate-700 ">1</td>
        <td class="text-left text-slate-700 p-2 ">NIK 132138594548</td>
        <td class="text-left p-2 font-bold text text-slate-700"><span class="flex text-left my-auto">IKN</span></td>
        <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Aktif</span></td>
        <td class="text-center p-2 cursor-pointer">
            <div class="flex justify-center">
                <img src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
            </div>
        </td>
  </tr>
  <tr class="bg-white h-14 gap-2 hTabel ">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
        <td class="text-center text-slate-700 ">1</td>
        <td class="text-left text-slate-700 p-2 ">NIK 132138594548</td>
        <td class="text-left p-2 font-bold text text-slate-700"><span class="flex text-left my-auto">IKN</span></td>
        <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Aktif</span></td>
        <td class="text-center p-2 cursor-pointer">
            <div class="flex justify-center">
                <img src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
            </div>
        </td>
  </tr>
  <tr class="bg-white h-14 gap-2 hTabel ">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
        <td class="text-center text-slate-700 ">1</td>
        <td class="text-left text-slate-700 p-2 ">NIK 132138594548</td>
        <td class="text-left p-2 font-bold text text-slate-700"><span class="flex text-left my-auto">IKN</span></td>
        <td class="text-center p-2"><span class="bg-slate-100 text-slate-800 p-2 rounded-xl">Non Aktif</span></td>
        <td class="text-center p-2 cursor-pointer">
            <div class="flex justify-center">
                <img src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
            </div>
        </td>
  </tr>
  <tr class="bg-white h-14 gap-2 hTabel ">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
        <td class="text-center text-slate-700 ">1</td>
        <td class="text-left text-slate-700 p-2 ">NIK 132138594548</td>
        <td class="text-left p-2 font-bold text text-slate-700"><span class="flex text-left my-auto">IKN</span></td>
        <td class="text-center p-2"><span class="bg-slate-100 text-slate-800 p-2 rounded-xl">Non Aktif</span></td>
        <td class="text-center p-2 cursor-pointer">
            <div class="flex justify-center">
                <img src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
            </div>
        </td>
  </tr>
  <tr class="bg-white h-14 gap-2 hTabel ">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
        <td class="text-center text-slate-700 ">1</td>
        <td class="text-left text-slate-700 p-2 ">NIK 132138594548</td>
        <td class="text-left p-2 font-bold text text-slate-700"><span class="flex text-left my-auto">IKN</span></td>
        <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Aktif</span></td>
        <td class="text-center p-2 cursor-pointer">
            <div class="flex justify-center">
                <img src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
            </div>
        </td>
  </tr>
  <tr class="bg-white h-14 gap-2 hTabel ">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
        <td class="text-center text-slate-700 ">1</td>
        <td class="text-left text-slate-700 p-2 ">NIK 132138594548</td>
        <td class="text-left p-2 font-bold text text-slate-700"><span class="flex text-left my-auto">IKN</span></td>
        <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Aktif</span></td>
        <td class="text-center p-2 cursor-pointer">
            <div class="flex justify-center">
                <img src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
            </div>
        </td>
  </tr>
  <tr class="bg-white h-14 gap-2 hTabel ">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
        <td class="text-center text-slate-700 ">1</td>
        <td class="text-left text-slate-700 p-2 ">NIK 132138594548</td>
        <td class="text-left p-2 font-bold text text-slate-700"><span class="flex text-left my-auto">IKN</span></td>
        <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Aktif</span></td>
        <td class="text-center p-2 cursor-pointer">
            <div class="flex justify-center">
                <img src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
            </div>
        </td>
  </tr>
  <tr class="bg-white h-14 gap-2 hTabel ">
    <td class="cursor-pointer text-center pl-2"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
        <td class="text-center text-slate-700 ">1</td>
        <td class="text-left text-slate-700 p-2 ">NIK 132138594548</td>
        <td class="text-left p-2 font-bold text text-slate-700"><span class="flex text-left my-auto">IKN</span></td>
        <td class="text-center p-2"><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">Aktif</span></td>
        <td class="text-center p-2 cursor-pointer">
            <div class="flex justify-center">
                <img src="{{ asset('/Icon-svg/mata.svg') }}" alt="icon">
            </div>
        </td>
  </tr>
 
</table>

<div class="flex badan_usaha_container bg-white ml-4 justify-between">
    <div class="flex ml-4 my-auto">
        <div class="flex bg-white rounded-lg shadow-md w-48 h-9 border-slate-200" >
          <div class="flex border px-3 rounded-md">
            <label for="role" class="text-slate-400 text-sm my-auto ">10</label>
            <button class=""></button>
            <img src="{{ asset('/Icon-svg/panahbawah.svg') }}" alt="role" class="my-auto ml-1 cursor-pointer">             
          </div>
            <span class="text-slate-400 text-sm my-auto ml-4">showing 1 - 10 of 85</span>                                    
        </div>
    </div>
     
    <div class="flex items-end my-auto mr-4 hFooter rounded-xl">  
        <div class="flex gap-3 mx-3 my-auto"> 
          <button><img src="{{ asset('/Icon-svg/previous.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/Icon-svg/back.svg') }}" alt="icon"></button>
        </div> 
        <div class="flex mx-3 my-auto">
          <button><span class="bg-blue-200 text-disetujuiTextColor py-1 px-3 rounded-md">1</span></button>        
          <button><span class="py-1 px-3 rounded-md">2</span></button>
          <button><span class="py-1 px-3 rounded-md">3</span></button>
          <button><span class="py-1 px-3 rounded-md">4</span></button>
        </div>
        <div class="flex gap-3 my-auto">
          <button><img src="{{ asset('/Icon-svg/next.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/Icon-svg/skip.svg') }}" alt="icon"></button>
        </div>
    </div>

@endsection