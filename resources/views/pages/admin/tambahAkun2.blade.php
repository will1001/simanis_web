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
        height: 1600px;
    }
    .boxer2{
        width: 220px;
        height: 47px;
        margin-left: 390px;
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
        height:1800px;
    }
    .mlicon{
        margin-left:280px;
        margin-top:10px;
    }
</style>
</head>
<body>
<div class="bg1 bg-slate-50 absolute">
<div class="mt-4 marginContainer">
    <h2 class="sla">Tambah Akun IKN</h2>
    <div class="flex boxer my-auto justify-between ml-10 cursor-pointer mt-4">          
        <img src="{{ asset('/Icon-svg/backTerang.svg') }}" alt="back" class="ml-2 mt-1">
        <span class="underline text-slate-700">kembali</span>
    </div> 
    <div class="flex mt-4 gap-5">
        <span class="text-xl font-bold text-slate-700">1. Pengaturan Akun</span>
        <span class="text-disetujuiTextColor underline text-xl font-bold">2. Badan Usaha</span>       
    </div>    
    <div class="flex flex-col boxer1 bg-white mt-3 rounded-lg shadow-lg gap-2">
        <span class="text-2xl gray300 font-semibold mt-4 mlt32">PROFIL UMUM</span>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Nama Direktur</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex flex-row justify-between mr-5 text-slate-800">          
            <span class="flex my-auto">ID Kabupaten</span> 
            <span class="flex">
                <input type="text" class="inputText rounded-md border">
                <img class="flex absolute iconSize mlicon cursor-pointer" src="{{ asset('/Icon-svg/panahbawah.svg') }}" alt="icon">
            </span>
        </div>       
        <div class="mlt32 flex flex-row justify-between mr-5 text-slate-800">          
            <span class="flex my-auto">Kecamatan</span> 
            <span class="flex">
                <input type="text" class="inputText rounded-md border">
                <img class="flex absolute iconSize mlicon cursor-pointer" src="{{ asset('/Icon-svg/panahbawah.svg') }}" alt="icon">
            </span>
        </div>       
        <div class="mlt32 flex flex-row justify-between mr-5 text-slate-800">          
            <span class="flex my-auto">Kelurahan</span> 
            <span class="flex">
                <input type="text" class="inputText rounded-md border">
                <img class="flex absolute iconSize mlicon cursor-pointer" src="{{ asset('/Icon-svg/panahbawah.svg') }}" alt="icon">
            </span>
        </div>   
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Alamat Lengkap</span> <input type="text" class="inputText rounded-md border">
        </div>    
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Nomor Hp</span> <input type="tel" class="inputText rounded-md border">
        </div>  
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Nama Usaha</span> <input type="text" class="inputText rounded-md border">
        </div>  
        <div class="mlt32 flex flex-row justify-between mr-5 text-slate-800">          
            <span class="flex my-auto">Bentuk Usaha</span> 
            <span class="flex">
                <input type="text" class="inputText rounded-md border">
                <img class="flex absolute iconSize mlicon cursor-pointer" src="{{ asset('/Icon-svg/panahbawah.svg') }}" alt="icon">
            </span>
        </div> 
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Tahun Berdiri</span> <input type="text" class="inputText rounded-md border">
        </div> 

        <span class="text-2xl gray300 font-semibold mt-4 mlt32">DETAIL BADAN USAHA</span>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Formal Informal</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">NIB Tahun</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Nomor Sertifikat Halal Tahun</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">SNI Tahun</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Jenis Usaha</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Cabang Industri</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Sub Cabang Industri</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">ID KBLI</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Investasi Modal</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Jumlah Tenaga Kerja Pria</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Jumlah Tenaga Kerja Wanita</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Kapasitas Produksi Perbulan</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Nilai Bahan Baku Perbulan</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">IAT</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">ING</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Media Sosial</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Foto Alat Produksi</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="mlt32 flex justify-between mr-5 text-slate-800">
            <span class="my-auto">Foto Ruang Produksi</span> <input type="text" class="inputText rounded-md border">
        </div>

        <div class=" flex flex-row boxer2 my-auto cursor-pointer gap-2 items-center justify-center bg-disetujuiTextColor rounded-md">
            <span class="text-xl font-medium text-white">Simpan Akun IKN</span>            
        </div>
    </div>
    
</div>
</div>

</body>
</html>