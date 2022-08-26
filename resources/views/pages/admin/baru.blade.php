@extends('layouts.admin')
<style>
    .actionContainer{
        width: 800px;
    }
</style>
@section('content')
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
            <input type="button" value="Tambah Akun" class=" text-white text-sm font-bold my-auto mx-auto h-[17px] w-[85px]">    
        </div>
    </div>
    <div class="">
        <div class="flex w-[140px] h-[52px] bg-slate-100 rounded-lg bg-cover mt-4 shadow-md ml-2  text-center">
            <input type="button" value="Hapus Akun" class="text-slate-800 text-sm font-bold my-auto ml-5 h-[17px] w-[85px]">
          <img src="{{ asset('/icon svg/sampah.svg') }}" alt="role" class="flex ml-2 my-auto ">
        </div>
    </div>
</div>

<table class="actionContainer rounded-2xl mt-4"> 
  <tr class="bg-tableColor-900 text-center text-white p-2 h-6">
    <th class="text-center p-2 rounded-tl-xl"><input type="checkbox" name="all" id="all"></th>
    <th class="text-center p-2 ">No</th>
    <th class="text-left p-2 pr-10">NIK</th>
    <th class="text-center p-2 ">Role</th>     
    <th class="text-center p-2 ">Staus</th>          
    <th class="text-center p-2 rounded-tr-xl">Aksi</th>   
  <tr>
  <th class="text-center p-2 rounded-tl-xl"><input type="checkbox" name="all" id="all"></th>
    <th class="text-center p-2">1</th>
    <th class="text-left p-2 ">NIK 132138594548</th>
    <th class="text-center p-2 ">IKN</th>     
    <th class="text-center p-2 ">Aktif</th>          
    <th class="text-center p-2 rounded-tr-xl">Aksi</th>  
  </tr>
  
 
</table>
@endsection