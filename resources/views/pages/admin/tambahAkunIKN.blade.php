<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- @vite('resources/css/app.css') -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin_template/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('admin_template/assets/img/favicon.png') }}">
  <title>
   SIMANIS NTB
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('admin_template/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin_template/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('admin_template/assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    <style>
    .actionContainer{
        width: 922px;
    }
    .inputText{
        width: 312px;
        height: 40px;
    }
    .boxer{
        width: 90px;
        height: 20px;
    }
    .boxer1{
        width: 628px;
        height: 420px;
    }
    .boxer2{
        width: 160px;
        height: 48px;
        margin-left: 450px;
    }
    .iconSize{
        width: 18px;
        height: 18px;
    }
    .radioSize{
        width: 20px;
        height: 20px;
    }
    .marginContainer{
        margin-left: 159px;
        margin-top: 48px;
    }
    .mlt32{
        margin-left: 32px;
        margin-top: 32x;
    }
    .spacing{       
        letter-spacing: 1px;
    }
    .gray300{       
        color: #D1D5DB;
    }
    .bg1{
        width:100%;
        height:100%
    }
</style>
</head>
<body>
<div class="bg1 bg-slate-50 absolute">
<div class="mt-4 marginContainer">
    <h2 class="sla">Tambah Akun IKN</h2>
    <div class="flex boxer my-auto justify-between ml-10 cursor-pointer mt-4">          
        <img src="{{ asset('/icon svg/backTerang.svg') }}" alt="back" class="ml-2 mt-1">
        <span class="underline text-slate-700">kembali</span>
    </div> 
    <div class="flex mt-4 gap-5">
        <span class="text-disetujuiTextColor underline text-xl font-bold">1. Pengaturan Akun</span>
        <span class="text-xl font-bold text-slate-700">2. Badan Usaha</span>
    </div>    
    <div class="flex flex-col boxer1 bg-white mt-3 rounded-lg shadow-lg gap-3">
        <span class="text-2xl gray300 font-semibold mt-4 mlt32">INFORMASI AKUN</span>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">username</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">email</span> <input type="email" class="inputText rounded-md border">
        </div>
        <span class="text-2xl gray300 font-semibold mt-4 mlt32">PASSWORD</span>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">set password baru</span> <input type="password" class="inputText rounded-md border">
        </div>
        <div class=" flex flex-row boxer2 my-auto cursor-pointer gap-2 items-center justify-center bg-disetujuiTextColor rounded-md">
            <span class="text-xl font-semibold text-white">Next</span>
            <img class="my-auto" src="{{ asset('/icon svg/iconMail.svg') }}" alt="">
        </div>
    </div>
    
</div>
</div>

</body>
</html>





