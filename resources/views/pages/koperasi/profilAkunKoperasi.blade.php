@extends('layouts.koperasi')
<style>
    .badan_usaha_container,
    p,
    .btn {
        margin: 20px 0;
    }
    .box {
        width: 700px;
        height: 670px;
        padding: 42px;
    }
    .box2 {
        width: 190px;
        height: 47px;
        padding: 12px;
    }
    .gray300{       
        color: #D1D5DB;
    }
    .inputText{
        width: 300px;
        height: 40px;
    }
    .bg1{
        width:100%;
        height:1000px;
    }
    .ml1{
        margin-left: 430px;
    }
</style>
@section('content')



<h2 class="ml-4">Profil Akun Koperasi</h2>

<div class="flex flex-col box bg-white ml-4 mt-4 gap-2 rounded-2xl shadow-lg">
    <span class="text-2xl gray300 font-semibold">INFORMASI AKUN</span>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Username</span> <input type="text" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Email</span> <input type="email" class="inputText rounded-md border">
    </div>    
    
    <span class="text-2xl gray300 font-semibold mt-4">UBAH PASSWORD</span>

    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Password Lama</span> <input type="password" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Password Baru</span> <input type="password" class="inputText rounded-md border">
    </div>
    <div class="flex justify-between text-slate-800">
            <span class="my-auto">Konfirmasi Password Baru</span> <input type="password" class="inputText rounded-md border">
    </div>
    <div class="box2 bg-disetujuiTextColor text-white flex justify-center mt-4 ml1 rounded-lg cursor-pointer">
        <span class="font-bold">Simpan Perubahan</span>
    </div>
</div>
<div class="bg1 bg-slate-150"></div>
@endsection