@extends('layouts.koperasi')
<style>
    .badan_usaha_container,
    p,
    .btn {
        margin: 20px 0;
    }
    .box {
        width: 980px;
        height: 900px;
        padding: 42px;
    }
    .box2 {
        width: 450px;
        height: 132px;
        padding: 20px;
    }
    .gray300{       
        color: #D1D5DB;
    }
    .inputText{
        width: 180px;
        height: 40px;
    }
    .bg1{
        width:100%;
        height:1000px;
    }
    .mt1 {
        margin-top: 95px;
    }
    .w1 {
        width: 382px; 
    }
    .w2 {
        width: 900px; 
    }
    .mb1 {
        margin-top:600px;
    }
    .mb2 {
        margin-top:65px;
    }
</style>
@section('content')



<h2 class="ml-4">Simulasi Angsuran</h2>

<div class="flex mt-4 gap-5 ml-4">
    <span class="text-xl font-bold text-slate-700">Murobhahah</span>
    <span class="text-disetujuiTextColor underline text-xl font-bold">Mudharobah</span> 
    <span class="text-xl font-bold text-slate-700">Musyarakah</span> 
         
</div> 


<div class="flex box gap-4 justify-between bg-white mt-4 rounded-2xl shadow-lg">
    <div class="flex flex-col gap-2 ">
        <div class="flex flex-row gap-4">
            <span class="text-slate-800">Nama Calon Mitra</span><span class="text-slate-800 font-bold">:Syukron Hadi</span>
        </div>
            <span class="text-slate-800 text-2xl my-2 font-semibold">Simulasi Akad Mudharobah (Rabat Jalan)</span>
            <span class="text-2xl gray300 font-semibold">INFORMASI UMUM</span>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Nilai Kontrak</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Modal Kerja</span> <input type="text" class="inputText rounded-md border">
        </div>
         <div class="flex justify-between text-slate-800">
            <span class="my-auto">Laba Kotor</span> <input type="text" class="inputText rounded-md border">
         </div>
            
        <span class="text-2xl gray300 font-semibold">BIAYA DAN LABA</span>

        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Biaya Kontrak</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Pajak</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Biaya Administrasi Pho</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Total Biaya</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Laba Bersih</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex flex-row justify-between box2 bg-disetujuiBgColor mb2 rounded-lg">
            <div class="flex flex-col  text-gray300"> 
                <span class="">Terbit</span>
                <span class="">Rencana Realisasi</span>
                <span class="">Jatuh Tempo</span>
                <span class="">Realisasi Pembiayaan</span>
            </div>
            <div class="flex flex-col text-slate-800"> 
                <span class="font-bold mr-5">: Mataran, 14 Juni 2022    </span>
                <span class="font-bold mr-5">: Rp20.000.000</span>
                <span class="font-bold mr-5">: 20 Oktober 2022</span>
                <span class="font-bold mr-5">: Rp24.000.000</span>
            </div>
        </div>

    </div>
    <div class="flex flex-col gap-2 mt1 w1">       
        <span class="text-2xl gray300 font-semibold">NISBAH</span>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">BMT</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Mitra</span> <input type="text" class="inputText rounded-md border">
        </div>
            
        <span class="text-2xl gray300 font-semibold my-2"><hr></span>

        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Total Pengembalian</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Jangka Waktu</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex justify-between text-slate-800">
            <span class="my-auto">Kontrol</span> <input type="text" class="inputText rounded-md border">
        </div>
        <div class="flex bg-disetujuiBgColor text-disetujuiTextColor p-2 rounded-lg mt-4">
            <span class="my-auto mx-auto font-bold text-2xl">Layak</span>
        </div>
    </div>   
    <hr class="w2 h-2 absolute mb1 ">      
</div>
<div class="bg1 bg-slate-150"></div>
@endsection