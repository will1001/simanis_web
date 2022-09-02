@extends('layouts.member')
<style>
    .actionContainer{
        width: 1000px;
        height:2000px;
    }
    .inputStyle{
        width: 500px;
    }
</style>
@section('content')
<div>
   <h2>Profil Member IKM</h2>
   <span class="mr-2"><a  href="{{ url('/member/settingAkun') }}" class="text-blue-700">1. Pengaturan Akun</a></span>
   <span><a href="{{ url('/member/settingBadanUsaha') }}">2. Badan Usaha</a></span>
</div>
<br>
<br>
<div class="actionContainer p-5 bg-white rounded-xl">
   <h3 class="text-textColor1">INFORMASI AKUN</h3>
   <div class="flex justify-between">
      <span>Email</span>
      <input class="inputStyle border-1 border-gray-600 border-solid rounded-md p-2 font-bold text-black" type="text" placeholder="Email">
   </div>
   <h3 class="text-textColor1">ubah password</h3>
   <div class="flex justify-between mt-5">
      <span>Password Lama</span>
      <input class="inputStyle border-1 border-gray-600 border-solid rounded-md p-2 font-bold text-black" type="text" placeholder="Password Lama">
   </div>
   <div class="flex justify-between mt-5">
      <span>Password Baru</span>
      <input class="inputStyle border-1 border-gray-600 border-solid rounded-md p-2 font-bold text-black" type="text" placeholder="Password Baru">
   </div>
   <div class="flex justify-between mt-5">
      <span>Konfirmasi Password Baru</span>
      <input class="inputStyle border-1 border-gray-600 border-solid rounded-md p-2 font-bold text-black" type="text" placeholder="Konfirmasi Password Baru">
   </div>
   <div class="flex justify-end items-center mt-5">
      <div class="flex p-4 bg-buttonColor-900 cursor-pointer text-white rounded-xl font-bold text-xl"><span>Simpan Perubahan</span></div>
   </div>
</div>


@endsection