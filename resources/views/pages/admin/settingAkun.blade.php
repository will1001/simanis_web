@extends('layouts.admin')
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
<!-- <div>
   <h2>Profil Member IKM</h2>
   <span class="mr-2"><a  href="{{ url('/member/settingAkun') }}" class="text-blue-700">1. Pengaturan Akun</a></span>
   <span><a href="{{ url('/member/settingBadanUsaha') }}">2. Badan Usaha</a></span>
</div> -->
<br>
<br>
<div class="actionContainer p-5 bg-white rounded-xl">
   <h3 class="text-textColor1">INFORMASI AKUN</h3>
   <form action="/changePassword/admin" method="post">
      @csrf
   <input name="id" type="text" value="{{$User->id}}" class="hidden">
   <h3 class="text-textColor1">ubah password</h3>
   <div class="flex justify-between mt-5">
      <span>Password Lama</span>
      <input name="password_lama" class="inputStyle border-1 border-gray-600 border-solid rounded-md p-2 font-bold text-black" type="password" placeholder="Password Lama" required>
   </div>
   <div class="flex justify-between mt-5">
      <span>Password Baru</span>
      <input id="password" name="password" class="inputStyle border-1 border-gray-600 border-solid rounded-md p-2 font-bold text-black" type="password" placeholder="Password Baru" required>
   </div>
   <div class="flex justify-between mt-5">
      <span>Konfirmasi Password Baru</span>
      <input id="confirm_password" class="inputStyle border-1 border-gray-600 border-solid rounded-md p-2 font-bold text-black" type="password" placeholder="Konfirmasi Password Baru" required>
   </div>
   <div class="flex justify-end items-center mt-5">
      <button onclick="checkConfirmPassword(event)" class="flex p-4 bg-buttonColor-900 cursor-pointer text-white rounded-xl font-bold text-xl"><span>Simpan Perubahan</span></button>
   </div>
   </form>
   <div id="password_info" style="visibility: collapse;" class="flex items-center p-3 rounded-xl bg-ditolakBgColor text-ditolakTextColor">
        <img class="mr-2" src="{{ asset('/Icon-svg/warning.svg') }}" alt="">
        <span>Konfirmasi Password Tidak Sama</span>
    </div>
    @if (\Session::has('failed'))
    <div class="flex items-center p-3 rounded-xl bg-ditolakBgColor text-ditolakTextColor">
        <img class="mr-2" src="{{ asset('/Icon-svg/warning.svg') }}" alt="">
        <span>{!! \Session::get('failed') !!}</span>
    </div>
   @endif
    @if (\Session::has('success'))
    <div class="flex items-center p-3 rounded-xl bg-green-600 text-white">
        <img class="mr-2" src="{{ asset('/Icon-svg/warning.svg') }}" alt="">
        <span>{!! \Session::get('success') !!}</span>
    </div>
   @endif
</div>


@endsection
<script>

   const checkConfirmPassword =(e)=>{
      const password = document.getElementById('password');
      const confirm_password = document.getElementById('confirm_password');
      const password_info = document.getElementById('password_info');

      if(password.value !== confirm_password.value){
         password_info.style.visibility = "visible";
         e.preventDefault();
      }else{
         password_info.style.visibility = "collapse";
      }
      
   }

</script>