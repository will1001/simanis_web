@extends('layouts.admin')
<style>
    .actionContainer{
        width: 922px;
    }
    .boxer{
        width: 393px;
        height: 318px;
    }
    .iconSize{
        width: 18px;
        height: 18px;
    }
    .radioSize{
        width: 20px;
        height: 20px;
    }
</style>
@section('content')
<div style="visibility: collapse;" id="detailPopUpBlackbg" class="bg-black opacity-40 w-full h-full fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-30">
</div>

<div style="visibility: collapse;" id="detailPopUp" class="fixed boxer top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col bg-white rounded-2xl">
    <div onclick="closeDetails()" class="flex-row-reverse flex cursor-pointer"><img src="{{ asset('/icon svg/exit.svg') }}" class="iconSize mt-3 mr-2" alt="close"></div>
    <span class="font-extrabold text-xl translate-x-1 text-slate-800 ml-5 mt-2 ">Tambah Akun</span>
    <div class="flex-col ml-5">
      <div class="flex flex-row items-center mt-4"><input type="radio" name="" id="" class="radioSize"><span class="ml-3 my-auto text-slate-800 font-semibold">IKN</span></div>
      <div class="flex flex-row items-center mt-3"><input type="radio" name="" id="" class="radioSize"><span class="ml-3 my-auto text-slate-800 font-semibold">Bank</span></div>
      <div class="flex flex-row items-center mt-3"><input type="radio" name="" id="" class="radioSize"><span class="ml-3 my-auto text-slate-800 font-semibold">Koperasi</span></div>
    </div>
    <div class="flex flex-row mx-auto gap-4">
      <div class="flex w-[140px] h-[52px] bg-slate-50 rounded-lg bg-cover mt-4 shadow-md">
          <input type="button" value="Cancel" class=" text-slate-10000 text-sm font-bold my-auto mx-auto h-[17px] w-[85px]">    
      </div>
      <div class="flex w-[140px] h-[52px] bg-blue-400 rounded-lg bg-cover mt-4 shadow-md">
          <input type="button" value="Tambah Akun" class=" text-white text-sm font-bold my-auto mx-auto h-[17px] w-[85px]">    
      </div>
    </div>  
</div>


<div id="popUpBlackbg" class="bg-slate-50 container max-w-full max-h-full actinContainer" >
  <h3 class="mt-14 font-extrabold w-[192px] h-[37px] text-slate-800">Daftar Akun</h3>
  <div class="flex justify-between items-center actionContainer">
    <div class="flex">
        <div class="flex w-[263px] h-[52px] bg-white rounded-lg bg-cover mt-4 shadow-md">
            <img src="{{ asset('/icon svg/medium.svg') }}" alt="search" class="h-8 w-8 ml-[18.5px] my-auto">
            <input type="text" placeholder="Cari NIK" class="my-auto h-6 w-[205px] ml-3 placeholder:text-sm ">
        </div>
        <div class="flex">
            <div class="flex w-[154px] h-[52px] bg-white rounded-lg bg-cover mt-4 shadow-md ml-2  text-center">
                <label for="role" class="text-slate-800 text-sm font-bold my-auto ml-5 h-[17px] w-[85px]">Semua Role</label>
                <input type="radio" id="role" name="role" class="hidden">
                <img src="{{ asset('/icon svg/icon.svg') }}" alt="role" class="flex ml-[18.5px] my-auto">
            </div>
        </div>
         <div class="flex w-[140px] h-[52px] bg-blue-400 rounded-lg bg-cover mt-4 shadow-md ml-[210px]">
            <input onclick="lihatDetails()" type="button" value="Tambah Akun" class=" text-white text-sm font-bold my-auto mx-auto h-[17px] w-[85px]">    
        </div>
    </div>
    <div class="">
        <div class="flex w-[140px] h-[52px] bg-slate-100 rounded-lg bg-cover mt-4 shadow-md ml-2  text-center">
            <input type="button" value="Hapus Akun" class="text-slate-800 text-sm font-bold my-auto ml-5 h-[17px] w-[85px]">
          <img src="{{ asset('/icon svg/sampah.svg') }}" alt="role" class="flex ml-2 my-auto ">
        </div>
    </div>
  </div>

  <table class="actionContainer justify-between rounded-2xl mt-4 shadow-lg"> 
  <tr class="bg-tableColor-900 text-white text-center h-16">
    <th class="text-center p-3 rounded-tl-xl"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <th class="text-center p-2">No</th>
    <th class="text-left pr-[250px]">NIK</th>
    <th class="text-left  ">Role</th>     
    <th class="text-left  ">Staus</th>          
    <th class="text-left p-2 rounded-tr-xl">Aksi</th>   
  </tr>
  @foreach($User as $key=>$item)

  <tr class="bg-white">
  <td class="text-center p-3"><span class="py-auto px-1 border-2 rounded-md"><input type="checkbox" name="all" id="all" class=" invisible "></span></th>
    <td class="text-center text-slate-700 ">{{++$key}}</td>
    <td class="text-left text-slate-700 ">{{$item->nik}}</td>
    <td class="text-left  text-slate-700 font-bold">{{$item->role}}</td>
    <td class="text-left  "><span class="bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-xl">{{$item->status}}</span></td>
    <td class="text-center p-2">
      <div class="flex ml-2">
        <img src="{{ asset('/icon svg/mata.svg') }}" alt="icon">
        <span class="bg-ditolakTextColor text-white p-2 rounded-xl"><img src="{{ asset('/icon svg/dilarang.svg') }}" alt="icon"></span>
      </div>
    </td>
  </tr>
  @endforeach
 
  </table>
  <div class="flex actionContainer bg-white mt-1">
    <div class="flex  actionContainer">
        <div class="flex bg-white rounded-lg mt-4 shadow-md w-48 h-9 border-slate-200" >
          <div class="flex border px-3 rounded-md">
            <label for="role" class="text-slate-400 text-sm my-auto ">10</label>
            <button class=""></button>
            <img src="{{ asset('/icon svg/panahbawah.svg') }}" alt="role" class="my-auto ml-1 cursor-pointer">             
          </div>
            <span class="text-slate-400 text-sm my-auto ml-4">showing 1 - 10 of 85</span>                                    
        </div>
    </div>
    <div class="flex actionContainer justify-end mt-4">  
        <div class="flex gap-3 mx-3"> 
          <button><img src="{{ asset('/icon svg/previous.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/icon svg/back.svg') }}" alt="icon"></button>
        </div> 
        <div class="flex">
          <button><span class="bg-blue-200 text-disetujuiTextColor py-1 px-3 rounded-md">1</span></button>        
          <button><span class="py-1 px-3 rounded-md">2</span></button>
          <button><span class="py-1 px-3 rounded-md">3</span></button>
          <button><span class="py-1 px-3 rounded-md">4</span></button>
        </div>
        <div class="flex gap-3 mx-3">
          <button><img src="{{ asset('/icon svg/next.svg') }}" alt="icon"></button>
          <button><img src="{{ asset('/icon svg/skip.svg') }}" alt="icon"></button>
        </div>
    </div>
  </div>



  

  
</div>



@endsection

<script>
 const lihatDetails = ()=>{
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    blackBg.style.visibility = "visible";
    detailPopUp.style.visibility = "visible";
  }
  const closeDetails = ()=>{
    const blackBg = document.getElementById('detailPopUpBlackbg');
    const detailPopUp = document.getElementById('detailPopUp');
    blackBg.style.visibility = "collapse";
    detailPopUp.style.visibility = "collapse";
  }
</script>